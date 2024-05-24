<?php

namespace App\Http\Livewire\Admin\Affiliate;

use App\Http\Traits\WithSorting;
use App\Models\AffiliateCommission;
use App\Models\AffiliateUsers;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithSorting;
    use WithPagination;
    public $banUserModal = false;
    public $unbanUserModal = false;
    public $banUserId;
    public $selectedAffiliate;
    public $openUsersModal = false;

    public $openPaymentModal = false;
    public $paymentId;

    public $sortField = 'id';
    public $sortAsc = false;

    public $showCommissionModal = false;
    public $affiliateCommissions = [];
    public function render()
    {

        $affiliates = User::leftJoin('affiliate_users as afl', function ($join) {
            $join->on('users.id', '=', 'afl.affiliate_id')->where('afl.verified', '=', true);

        })
            ->selectRaw('users.id,users.name,users.email, sum(CASE When afl.status = "Pending" Then afl.commission END) pending_commission, sum(afl.commission) as total_commission ,count(afl.id) as total_users,users.created_at, users.is_affiliate')
             ->when($this->sortField, function($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })
            ->groupBy('users.id', 'users.name', 'users.email')
            ->whereNotNull('affiliate_link')

            ->latest()->paginate(20, ['*'], 'affiliate');
        if ($this->openUsersModal && isset($this->selectedAffiliate)) {
            $users = AffiliateUsers::where('affiliate_id', $this->selectedAffiliate)->where('verified', true)->latest()->paginate(10);
        } else {
            $users = [];
        }
        return view('livewire.admin.affiliate.index', ['affiliates' => $affiliates, 'users' => $users])->layout('components.admin-layout');;
    }

    public function banUser()
    {
        if (isset($this->banUserId)) {
            User::find($this->banUserId)->update([
                'is_affiliate' => false
            ]);
            $this->closeBanModal();
            session()->flash('success', 'User banned successfully');
        }
    }
    public function sortBy($field) {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function openBanModal($id)
    {
        $this->banUserId = $id;
        $this->banUserModal  = true;
    }

    public function closeBanModal()
    {
        $this->reset(['banUserId', 'banUserModal']);
    }

    public function openUnBanModal($id)
    {
        $this->banUserId = $id;
        $this->unbanUserModal = true;
    }

    public function unBanUser()
    {
        if (isset($this->banUserId)) {
            User::find($this->banUserId)->update([
                'is_affiliate' => true
            ]);
            $this->closeUnBanModal();
            session()->flash('success', 'User unbanned successfully');
        }
    }

    public function closeUnBanModal()
    {
        $this->reset(['banUserId', 'unbanUserModal']);
    }
    public function openUsersModal($id)
    {
        $this->selectedAffiliate = $id;
        $this->openUsersModal = true;

    }

    public function closeUsersModal()
    {
        $this->reset(['selectedAffiliate', 'openUsersModal']);
    }

    public function openPaymentModal($id)
    {
        $this->paymentId = $id;
        $this->openPaymentModal = true;
    }

    public function closePaymentModal()
    {
        $this->reset(['paymentId', 'openPaymentModal']);
    }

    public function payUser()
    {
        if($this->paymentId){
            // AffiliateUsers::where('affiliate_id', $this->paymentId)->update([
            //     'status' => 'Paid'
            // ]);
            AffiliateCommission::find($this->paymentId)->update([
                'status' => 'Paid'
            ]);
            $this->affiliateCommissions->where('id', $this->paymentId)->first()->update([
                'status' => 'Paid'
            ]);
        }
        else {

            AffiliateUsers::where('status' , 'Pending')->update([
                'status' => 'Paid'
            ]);
            AffiliateCommission::where('status', 'Pending')->update([
                'status' => 'Paid'
            ]);
        }


        $this->reset(['paymentId', 'openPaymentModal']);
        session()->flash('success', 'Status Changed Successfully');
    }

    public function showHistory($affiliate_id)
    {

        $this->affiliateCommissions = AffiliateCommission::where('affiliate_user_id', $affiliate_id)->get();
        $this->showCommissionModal = true;
    }

    public function closeHistoryModal()
    {
        $this->reset(['showCommissionModal', 'affiliateCommissions']);
    }

    public function changeCommissionStatus($id)
    {
        AffiliateCommission::find($id)->update([
            'status' => 'Paid'
        ]);
        $this->affiliateCommissions->where('id', $id)->first()->update([
            'status' => 'Paid'
        ]);
        // $this->affiliateCommissions = AffiliateCommission::where('affiliate_user_id', $affiliate_id)->get();

    }

    public function checkStatus($id , $table = null)
    {

        if($table == 'commission'){

            $commission = AffiliateCommission::where('affiliate_user_id', $id)->where('status', 'Pending')->count();
            return $commission;

        }
        else{
            $commission = AffiliateUsers::withCount(['commissions' => function($query){
                $query->where('status', 'Pending');
            }])->where('affiliate_id', $id)->where('verified', true)->get();
            return $commission->where('commissions_count', '>', 0)->count();
        }

    }




}
