<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::with('user')->paginate(10);

        $ranks = [
            ['min' => 0, 'max' => 1000, 'rank' => 'Đồng', 'img' => 'storage/uploads/ranks/bronze.svg'],
            ['min' => 1001, 'max' => 3000, 'rank' => 'Bạc', 'img' => 'storage/uploads/ranks/silver.svg'],
            ['min' => 3001, 'max' => 10000, 'rank' => 'Vàng', 'img' => 'storage/uploads/ranks/gold.svg'],
            ['min' => 10001, 'max' => PHP_INT_MAX, 'rank' => 'Kim cương', 'img' => 'storage/uploads/ranks/diamond.svg']
        ];
    
        // Lặp qua từng membership và tính rank dựa theo điểm
        foreach ($memberships as $membership) {
            $points = $membership->points; // Lấy điểm của thành viên hiện tại
            $currentRank = null;
    
            // Tính rank dựa theo điểm của thành viên hiện tại
            foreach ($ranks as $rank) {
                if ($points >= $rank['min'] && $points <= $rank['max']) {
                    $currentRank = $rank;
                    break;
                }
            }
    
            // Gán rank cho mỗi membership
            $membership->rank = $currentRank['rank'];
            $membership->rank_img = $currentRank['img'];
        }
    
        // Trả về view với dữ liệu memberships
        return view('admins.memberships.index', compact('memberships'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
    
        return view('admins.memberships.detail');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
