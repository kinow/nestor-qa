<?php

namespace Nestor\Http\Controllers;

use Illuminate\Http\Request;

use Nestor\Http\Requests;
use Nestor\Http\Controllers\Controller;

/**
 * Test Suite resource representation.
 *
 * @Resource("Test Suites", uri="/testsuites")
 */
class TestSuitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            [
                'id' => 10,
                'name' => 'Suite 001',
                'description' => 'This is the first test suite'
            ],
            [
                'id' => 20,
                'name' => 'Dummy Suite #2',
                'description' => 'And this is the second test suite'
            ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [
                'id' => (int) $id,
                'name' => sprintf('Test Suite fake %s', $id),
                'description' => sprintf('Le description du test suite %s', $id)
            ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
