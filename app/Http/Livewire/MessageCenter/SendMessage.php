<?php

namespace App\Http\Livewire\MessageCenter;

use App\Enums\EmailTemplateType;
use App\Enums\ReportType;
use App\Events\MessageNotif;
use App\Events\MessageSent;
use App\Jobs\SendEmailJob;
use App\Models\ChatCenter\Chat;
use App\Models\ChatCenter\ChatMessage;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Proposal;
use App\Models\Report;
use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use App\Models\User;
use App\Rules\SpamDetection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class SendMessage extends Component
{
    use WithFileUploads;

    public $selectedChat;
    public $receiverInstance;
    public $body;
    public $show;
    public $createdMessage;
    public $blocked;
    public $chatId;
    public $attachments = [];

    protected $listeners = ['updateSendMessage', 'dispatchMessageSent', 'blocked', 'unBlocked', 'blockRefresh' => '$refresh', 'timeoutReached'];

    public $uploadProgress = 0;
    public $uploading = false;

    public $allowedFileTypes = 'image/*,application/pdf,text/plain,.zip';

    protected $rules = [

            'attachments' => ['array', 'max:5'],
            'attachments.*' => ['mimes:png,doc,docx,jpg,jpeg,pdf,txt,zip', 'max:5120'],
            'attachments.*.size' => 'max:5120',
            'body' => 'string|max:20000|nullable'


    ];

    // protected $messages = [
    //     'attachments.array' => 'Failed to upload Attachment',
    //     'attachments.*' => 'Failed to upload file',
    //     'attachments.max' => 'Max 5 files allowed to upload',
    //     'attachments.*.mimes' => 'Incorrect file type allowed types png,jpg,jpeg,mp4,pdf,txt',

    //     'body.max' => 'Too long message'

    // ];
    // protected $validationAttributes = [
    //     'attachments.*' => 'File'
    // ];

    public function updatedAttachments()
    {

        $validatedData = Validator::make(
            [
                'attachments' => $this->attachments
            ],
            [
                'attachments' => ['array', 'max:5'],
                'attachments.*' => ['mimes:png,jpg,docx,jpeg,doc,pdf,txt,zip', 'max:5120']
            ],
            [
                'attachments.*.size' => 'Max file size is 5MB'
            ],
            [
                'attachments.*' => 'attachment'
            ]
        );

        if($validatedData->fails()) {
            $this->reset('body','attachments');
            $this->uploading = false;
            $this->addError('error', $validatedData->errors()->first());
            return;
        }

    }
        public function timeoutReached()
        {

            $this->resetErrorBag();
            $this->uploading = false;

        }

    public function mount()
    {
        if ($this->chatId) {
            $this->show = true;

            $this->selectedChat = Chat::where('id', $this->chatId)->first();
            if ($this->selectedChat->sender_id == auth()->user()->id) {
                $this->receiverInstance = User::firstWhere('id', $this->selectedChat->receiver_id);
            } else {
                $this->receiverInstance = User::firstWhere('id', $this->selectedChat->sender_id);
            }


            $this->updateSendMessage($this->selectedChat, $this->receiverInstance);

        } else {
            $this->show = false;
            $this->blocked = false;
        }

    }

    public function updateSendMessage(Chat $chat, User $receiver)
    {

        $this->selectedChat = $chat;

        $this->receiverInstance = $receiver;
        if ($this->selectedChat?->chatStatus?->blocked_by) {

            $this->show = false;
        } else {
            $this->show = true;
        }

    }

    public function sendMessage()
    {


        $validatedData = Validator::make(
            [
                'attachments' => $this->attachments
            ],
            [
                'attachments' => ['array', 'max:5'],
                'attachments.*' => ['mimes:png,jpg,docx,jpeg,doc,pdf,txt,zip', 'max:5120']
            ],
            [
                'attachments.*.size' => 'Max file size is 5mb'
            ],
            [
                'attachments.*' => 'attachment'
            ]
        );

        if($validatedData->fails()) {
            $this->reset('body','attachments');
            $this->addError('attachments', $validatedData->errors()->first());
            return;
        }


        if ($this->body == null && $this->attachments == null) {
            return null;
        }

        if ($this->body || $this->attachments) {

            if ($this->selectedChat->content_type == 'Gig') {
                $gig = Gig::where('id', $this->selectedChat->content_id)->first(['id', 'seller_id']);
                $seller = Seller::where('id', $gig->seller_id)->first(['user_id']);
                $sender = $seller->user_id == auth()->user()->id ? 'seller' : 'buyer';
            } elseif ($this->selectedChat->content_type == 'Order') {
                $order = Order::where('id', $this->selectedChat->content_id)->first(['id', 'seller_id']);
                $seller = Seller::where('id', $order->seller_id)->first(['user_id']);
                $sender = $seller->user_id == auth()->user()->id ? 'seller' : 'buyer';
            } elseif($this->selectedChat->content_type == 'Proposal'){
                // $proposal = Proposal::where('id', $this->selectedChat->content_id)->first(['id', 'seller_id']);
                // $seller = Seller::where('id', $proposal->seller_id)->first(['user_id']);
                $sender = $this->selectedChat->recevier_id == auth()->user()->id ? 'seller' : 'buyer';
            }
            $this->createdMessage = ChatMessage::create([
                'message' => $this->body ?? null,
                'chat_id' => $this->selectedChat->id,
                'sent_by' => $sender,
                'sender_id' => auth()->id(),
                'receiver_id' => $this->receiverInstance->id,
                'sent_at' => Carbon::now()

            ]);

            if (count($this->attachments) > 0) {
                $files = $this->attachments;

                foreach ($files as $key => $file) {
                    $ext = $file->extension();

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'txt', 'pdf', 'doc', 'docx', 'zip'])) {


                        $mimeType = $file->getMimeType();

                        $name = $file->getClientOriginalName();

                        $timestamp = Carbon::now()->timestamp;

                        $path = $file->storeAs('/attachments', $timestamp . '_' . $name, 'public');

                        $data = [
                            'name' => $name,
                            'file_url' => $path,
                            'file_type' => $mimeType
                        ];

                        $this->createdMessage->attachments()->create($data);
                    }
                }
            }

            $this->selectedChat->last_reply_at = $this->createdMessage->sent_at;
            $this->selectedChat->save();
            $this->uploading = false;

            // detect spam
            $containSpam = resolve(SpamDetection::class)->detect($this->body);
            if($containSpam){
                Report::create([
                    'content_type' => ReportType::Chat->value,
                    'content_id' => $this->selectedChat->id,
                    'message' => $this->body
                ]);

                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Spam Detected!',
                    'text' =>'Please avoid sending spam message. Your ID can be permanently banned',
                    'timer'=>6000,
                    'icon'=>'error',
                    'toast'=>true,
                    'position'=>'top-end',
                    'showConfirmButton' => false,
                ]);

            }

            $this->emitTo('message-center.chat-area', 'pushMessage', $this->createdMessage->id);
            $this->reset('body', 'attachments');

            // refresh chat list
            $this->emitTo('message-center.chat-list', 'refresh');
            $this->emitSelf('dispatchMessageSent');
            $lastMessage = $this->selectedChat->chatMessages()->where('receiver_id', $this->receiverInstance->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->first();

            if( $lastMessage?->is_seen == false ||  ($lastMessage?->is_seen == true && $lastMessage?->updated_at->lt(Carbon::now()->subMinute()))) {
                if ($mailDetail = Newsletter::where('type', EmailTemplateType::NewReply->value)->first()) {
                    $data = ['body' => $mailDetail->body, 'subject' => $mailDetail->subject];

                    if ($user = User::find($this->receiverInstance->id)) {
                        $mail_to = $user->email;
                        if($sender == 'buyer'){
                            $url = route('seller.message_details', ['id' => $this->selectedChat->id]);
                        } else{
                            $url = route('messages', ['id' => $this->selectedChat->id]);
                        }

                        dispatch(new SendEmailJob($data, $mail_to , $url));
                    }
                }
            }


        } else {
            return null;
        }


    }

    public function dispatchMessageSent()
    {

        broadcast(new MessageSent(auth()->user(), $this->createdMessage, $this->selectedChat, $this->receiverInstance));

        broadcast(new MessageNotif(auth()->user(), $this->receiverInstance));
    }

    public function blocked()
    {
        $this->blocked = true;
        $this->show = false;
    }

    public function unBlocked()
    {
        $this->blocked = false;
        $this->show = true;
    }



    public function render()
    {
        return view('livewire.message-center.send-message');
    }

    public function updatingAttachments()
    {
        $this->uploading = true;
    }
}
