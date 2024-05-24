<?php

namespace App\Http\Livewire\Forms;

use App\Models\Review;
use App\Models\Seller\GigStat;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerStat;
use Livewire\Component;

class ReviewForm extends Component
{
    public $comment;
    public $rating;
    public $openModal;
    public $order;
    public $from;
    public $isReviewed;


    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.forms.review-form');
    }

    public function mount()
    {
        $this->checkReview();
        $this->comment = '';
        $this->rating = 5;
        $this->openModal = false;
    }


    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

    public function addReview()
    {
        $this->checkReview();
        if(!$this->isReviewed){

            $seller = Seller::where('id', $this->order->seller_id)->first('user_id');
            if($this->from == 'seller'){
                Review::create([
                    'rating' => $this->rating,
                    'review' => $this->comment,
                    'gig_id' =>  $this->order->type == 'normal' ? $this->order->gig_id : null,
                    'order_id' => $this->order->id,
                    'from_user_id' => $seller->user_id,
                    'to_user_id' => $this->order->user_id,
                    'review_type' => 'seller'
                ]);

                return redirect(route('order_details', ['id' => $this->order->id]))->with('message', 'Review added successfully');
            } elseif($this->from == 'buyer'){

                Review::create([
                    'rating' => $this->rating,
                    'review' => $this->comment,
                    'gig_id' => $this->order->type == 'normal' ? $this->order->gig_id : null,
                    'order_id' => $this->order->id,
                    'from_user_id' => $this->order->user_id,
                    'to_user_id' => $seller->user_id,
                    'review_type' => 'buyer'
                ]);

                $sellerStat = SellerStat::where('seller_id', $this->order->seller_id)->first();

                $sellerStat->reviews_average = $this->reviewsAvgCalc($sellerStat->reviews_average, $sellerStat->total_reviews, $this->rating);
                $sellerStat->total_reviews += 1;
                $sellerStat->save();

                // update gig stats
                if($this->order->type == 'normal'){
                    $gigStats = GigStat::where('gig_id', $this->order->gig_id)->first();

                    $gigStats->reviews_average = $this->reviewsAvgCalc($gigStats->reviews_average, $gigStats->reviews_count, $this->rating);
                    $gigStats->reviews_count += 1;
                    $gigStats->save();

                }

                return redirect(route('buyerorder_details', ['id' => $this->order->id]))->with('message', 'Review added successfully');
            }
        }
    }

    public function reviewsAvgCalc($prev_reviews_avg, $prev_reviews_count, $new_review)
    {
        // ((prev_reviews_avg * $prev_reviews_count) + new_review) / prev_reviews_count + 1
        return (($prev_reviews_avg * $prev_reviews_count) + $new_review) / ++$prev_reviews_count;
    }

    public function checkReview()
    {
        if($this->from == 'seller') {
            $review = Review::where('order_id', $this->order->id)
                ->where('review_type', 'seller')
                ->first('id');
           if($review){
                $this->isReviewed = true;
           } else{
                $this->isReviewed = false;
           }
        } elseif($this->from == 'buyer') {
            $review = Review::where('order_id', $this->order->id)
            ->where('review_type', 'buyer')
            ->first('id');
            if($review){
                    $this->isReviewed = true;
            } else{
                    $this->isReviewed = false;
            }
        }  else{
            $this->isReviewed = false;
        }
    }
}
