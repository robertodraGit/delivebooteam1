<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;
use App\Plate;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {

        $user = Auth::user();

        // restituisco feedback dell'user
        $feedbacks = $user -> feedback;

        // restituisco email utente senza @provider etc
        $email_user = $user -> email;
        $word = '@';
        $mail_cut = substr($email_user, 0, strpos($email_user, $word));

        return view('dashboard', compact('mail_cut', 'feedbacks'));
    }

    public function stats() {

        $user = Auth::user();
        $plates = [];

        foreach ($user -> plates as $plate) {
            $plates[] = $plate -> plate_name;
        }

        $userOrdersId = [];
        foreach ($user -> plates as $plate) {

        $orders = [];
        foreach ($plate -> orders as $order) {
            $orders[] = $order;
            $userOrdersId[] = $order -> id;
        }
        $plateOrdersId[] = count($orders);
        }
  
        $userOrdersId = array_unique($userOrdersId);
        $userOrders = Order::findOrFail($userOrdersId);


        $counterFeedbacks = array (0,0,0,0,0);
        
        foreach ($user -> feedback as $fdb) {
            if ($fdb -> rate == 1) {
                $counterFeedbacks[0] += 1;
            } else if ($fdb -> rate == 2) {
                $counterFeedbacks[1] += 1;
            } else if ($fdb -> rate == 3) {
                $counterFeedbacks[2] += 1;
            } else if ($fdb -> rate == 4) {
                $counterFeedbacks[3] += 1;
            } else {
                $counterFeedbacks[4] += 1;
            }
        }

        // dd($counterFeedbacks, $plateOrdersId);

        $chartjs1 = app()->chartjs
        ->name('platesOrdered')
        ->type('bar')
        ->size(['width' => 500, 'height' => 200])
        ->labels($plates)
        ->datasets([
            [
                "label" => "Ordinazioni per piatto",
                'backgroundColor' => "rgba(0, 204, 188, 0.31)",
                'hoverBackgroundColor' => 'rgba(0, 204, 188, 0.51)',
                'data' => $plateOrdersId,
            ],
        ])
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => '#000'
                ]
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                        ],
                        'stacked' => true,
                        'gridLines' => [
                            'display' => true,
                        ],
                    ]
                ],
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                        ],
                        'stacked' => true,
                        'gridLines' => [
                            'display' => true,
                        ],
                    ]
                ]
            ]
        ]);

        $chartjs2 = app()->chartjs
        ->name('feedbacks')
        ->type('line')
        ->size(['width' => 500, 'height' => 200])
        ->labels([1, 2, 3, 4, 5])
        ->datasets([
            [
                "label" => "Feedbacks",
                'backgroundColor' => "rgba(0, 204, 188, 0.31)",
                'borderColor' => "rgba(0, 204, 188, 1)",
                'pointRadius' => 6,
                'pointHoverRadius' => 8,
                "pointBorderColor" => "rgba(0, 204, 188, 0.7)",
                "pointBackgroundColor" => "rgba(0, 204, 188, 1)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $counterFeedbacks,
            ],
        ])
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => '#000'
                ]
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'ticks' => [
                            // 'beginAtZero' => true,
                            'max' => 100,
                            'min' => 20,
                            'stepSize' => 10,
                        ],
                        'stacked' => true,
                        'gridLines' => [
                            'display' => true,
                        ],
                    ]
                ],
                'yAxes' => [
                    [
                        'ticks' => [
                            // 'beginAtZero' => true,
                            // 'max' => 100,
                            'min' => 20,
                            'stepSize' => 10,
                        ],
                        'stacked' => true,
                        'gridLines' => [
                            'display' => true,
                        ],
                    ]
                ]
            ]
        ]);

        return view('dashboard.stats', compact('chartjs1', 'chartjs2'));
    }

}
