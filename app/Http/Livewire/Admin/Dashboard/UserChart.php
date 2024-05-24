<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Seller\Seller;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class UserChart extends Component
{
    public array $data = [];
    public function render()
    {
        // user chart data
        $this->updateChart();

        // calculate users increased or decread than last week
        $usersIncOrDec = $this->getUsersPercentage();

        $users = $this->getUsers();

        return view('livewire.admin.dashboard.user-chart', [
            'usersIncOrDec' => $usersIncOrDec,
            'users' => $users
        ]);
    }

    public function updateChart()
    {
        // chart data
        $users = User::selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                                        ->groupBy('year', 'month')
                                        ->orderBy('year', 'desc')
                                        ->whereYear('created_at', Carbon::now())
                                        ->where('is_banned', 0)
                                        ->get();


        $this->data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach($users as $user) {
            $this->data[$user->month - 1] = $user->data;
        }

        // $this->data = array_splice($this->data, 0, Carbon::now()->month);

        // $this->emit('updateChart', ['data' => $this->data]);
    }

    public function getUsersPercentage()
    {
        $dateFrom = Carbon::now()->subDays(7);
        $dateTo = Carbon::now();

        $datePrevFrom = Carbon::now()->subDays(14);
        $datePrevTo = Carbon::now()->subDays(8);
        $stats = User::query()
                ->select('id')
                ->addSelect(['prev_users' => User::selectRaw('count(*) as total')
                                ->whereBetween('created_at', [$datePrevFrom, $datePrevTo])
                                ->where('is_banned', 0)
                            ])
                ->addSelect(['new_users' => User::selectRaw('count(*) as total')
                                ->whereDate('created_at', [$dateFrom, $dateTo])
                                ->where('is_banned', 0)
                            ])
                ->first();

        $total = $stats->prev_users > 0 ? round((($stats->new_users - $stats->prev_users) / $stats->prev_users) * 100) : 100;
        return $total > 0 ? '+'.$total : $total;
    }

    public function getUsers()
    {
        $users = User::where('is_banned', 0);
        $sellers = Seller::where('is_approved', 1)->count();

        $clone_admin = clone $users;
        $clone_ticket_manager = clone $users;
        $clone_users = clone $users;

        return [
                'users' => $clone_users->count(),
                'admins' => $clone_admin->where('is_admin', 1)->count(),
                'ticket_managers' => $clone_ticket_manager->where('is_ticket_manager', 1)->count(),
                'sellers' => $sellers
        ];
    }
}
