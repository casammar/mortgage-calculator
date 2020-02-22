<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

use App\Calculation;

class CalculationController extends Controller
{
    /**
     * Show the calculator form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calculations = Calculation::all();

        return view('calculation.index', compact('calculations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calculation.create');
    }

    /**
     * Process the calculator form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_type'=>'required',
            'loan_value'=>'required',
            'years'=>'required',
            'interest_rate'=>'required'
        ]);

        $calculation = new Calculation([
            'loan_type' => $request->get('loan_type'),
            'loan_value' => $request->get('loan_value'),
            'years' => $request->get('years'),
            'interest_rate' => $request->get('interest_rate')
        ]);
        $calculation->save();
        
        return redirect('/calculation/'.$calculation->id)->with('success', 'Contact saved!');
    }

    /**
     * Display the calculation result
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calculation = Calculation::findOrFail($id)->toArray();

        /*
        Number of Periodic Payments (n) = Payments per year times number of years
        Periodic Interest Rate (i) = Annual rate divided by number of payments per
        Discount Factor (D) = {[(1 + i) ^n] - 1} / [i(1 + i)^n]
        */

        # number of payments
        $n = $calculation['years'] * 12;
        $calculation['total_payments'] = $n;
        # interest rate
        $i = ($calculation['interest_rate'] / 100) / 12;
        $calculation['periodic_interest_rate'] = $i;
        # discount rate
        $d = (pow((1+$i), $n)-1)/($i * pow((1+$i), $n));
        $calculation['discount_factor'] = $i;
        #monthly payment amount
        $monthly_payment = round(($calculation['loan_value'] / $d), 2);
        $calculation['monthly_payment'] = $monthly_payment;

        return view('calculation.result', ['calculation' => $calculation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calculation = Calculation::find($id);
        return view('calculation.edit', compact('calculation')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'loan_type'=>'required',
            'loan_value'=>'required',
            'years'=>'required',
            'interest_rate'=>'required'
        ]);

        $calculation = Calculation::find($id);
        $calculation->loan_type = $request->get('loan_type');
        $calculation->loan_value = $request->get('loan_value');
        $calculation->years = $request->get('years');
        $calculation->interest_rate = $request->get('interest_rate');
        $calculation->save();
        return redirect('/calculation')->with('success', 'Calculation updated!');
    }

    /**
     * Remove the calculation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calculation = Calculation::find($id);
        $calculation->delete();

        return redirect('/calculation')->with('success', 'Calculation deleted!');
    }
}
