<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Prices as ModelsPrices;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
//use Livewire\Attributes\Reactive;
use Livewire\Component;

class Prices extends Component
{
    use LivewireAlert;

    public $title = "CPR Admin Prices";
    public $start_date = '';
    public $price_type = '';
    public $amount = '';
    public $current_prices = '';
    public $upcoming_prices;
    public $archived_prices = '';

    public function rules(): array
    {
        return [
            'price_type' => [
                'required',
                Rule::in(['registration', 'submission', 'renewal'])
            ],
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.required' => 'A start date is required',
            'start_date.date' => 'Invalid date',
        ];
    }

//    protected function getPrecedingPrice()
//    {
//        return ModelsPrices::where('price_type', $this->price_type)
//                           ->where('start_date', '<=', Carbon::parse($this->start_date))
//                           ->orderBy('start_date', 'desc')
//                           ->first();
//    }

    public function create(): void
    {
        $this->validate();

        // Delete any other pending price changes of this type.
        ModelsPrices::where('price_type', $this->price_type)
                    ->where('start_date', '>=', now())
                    ->delete();

        // Update previous price of this type, setting
        // the 'end_date' 1 second before the new prices 'start_date'.
        $previous_price = ModelsPrices::where('price_type', $this->price_type)
                                      ->where(function ($query) {
                                          $query->where('end_date', '>', now())
                                                ->orWhere('end_date', null);
                                      })
                                      ->first();

        $previous_price?->update([
            'end_date'   => Carbon::parse($this->start_date)->subSecond(),
            'updated_by' => Auth::user()->id,
        ]);

        ModelsPrices::create([
            'price_type' => $this->price_type,
            'amount' => $this->amount,
            'start_date' => $this->start_date,
            'updated_by' => Auth::user()->id,
        ]);

        $this->reset('price_type','amount','start_date', 'upcoming_prices');

        $this->flash(
            'success',
            'Price Added.', [
                'position' => 'top-end',
                'timer' => 2000,
                'showConfirmButton' => false,
                'confirmButtonColor' => '#10b981',
            ],
            request()->header('Referer')
        );
    }

    public function delete($dateId): void
    {
        try {

            $price_to_delete = ModelsPrices::find($dateId);

            $previous_price = ModelsPrices::where('price_type', $price_to_delete->price_type)
                                          ->where('end_date', '>', now())
                                          ->first();

            $previous_price?->update([
                'end_date'   => null,
                'updated_by' => Auth::user()->id,
            ]);

            $price_to_delete->delete();

            $this->flash(
                'info',
                'Scheduled Price Deleted.', [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ],
                request()->header('Referer')
            );
        } catch (Exception $e) {
            // $messageToDisplay = $e->getMessage(); // For useful dev feedback.
            $messageToDisplay = 'Unable to delete - somebody may have beaten you to it!'; // For production.

            $this->alert('error', $messageToDisplay, [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

    public function mount(): void
    {
        $this->current_prices = ModelsPrices::with('updatedBy')
                                            ->where('start_date', '<=', now())
                                            ->where(function($query) {
                                                 $query->where('end_date', '>', now())
                                                       ->orWhere('end_date', null);
                                             })
                                            ->orderBy('price_type')
                                            ->orderBy('start_date')
                                            ->get();

        $this->upcoming_prices = ModelsPrices::with('updatedBy')
                                             ->where('start_date', '>', now())
                                             ->where(function($query) {
                                                 $query->where('end_date', '>', now())
                                                       ->orWhere('end_date', null);
                                             })
                                             ->orderBy('start_date')
                                             ->orderBy('price_type')
                                             ->get();

        $this->archived_prices = ModelsPrices::with('updatedBy')
                                             ->where('end_date', '<', now())
                                             ->orderBy('price_type')
                                             ->orderByDesc('end_date')
                                             ->orderByDesc('start_date')
                                             ->get();
    }

    public function render()
    {
        return view('livewire.pages.cpr.prices')
            ->layout('layouts.app');
    }


}
