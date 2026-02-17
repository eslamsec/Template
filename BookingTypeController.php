<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\BookingType;
use Illuminate\Http\Request;

class BookingTypeController extends Controller
{
    public function list(Request $request)
    {
        $query = BookingType::orderBy('created_at', 'desc');
        if ($request->show_all) {
            $booking_types = $query->get();
        } else {
            $booking_types = $query->paginate(10);
        }
        if ($request->ajax()) {
            return view('room_master.booking_type.table', compact('booking_types'))->render();
        }

        return view('room_master.booking_type.list', compact('booking_types'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:booking_types,name|string|max:255',
        ]);
        $booking_type = BookingType::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['msg' => translate('BookingType created successfully')]);
    }

    public function table(Request $request)
    {
        $query = BookingType::query();

        if ($request->show_all) {
            $booking_types = $query->get();
        } else {
            $booking_types = $query->paginate(10);
        }
        return view('room_master.booking_type.table', compact('booking_types'));
    }

    public function edit($id)
    {
        $booking_type = BookingType::findOrFail($id);
        return response()->json($booking_type);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:booking_types,name,' . $id . '|string|max:255',
        ]);

        $booking_type = BookingType::findOrFail($id);
        $booking_type->update([
            'name' => $request->input('name'),
        ]);

        return response()->json(['msg' => translate('BookingType updated successfully')]);
    }
    public function delete($id)
    {
        $booking_type = BookingType::findOrFail($id);
        $booking_type->delete();

        return response()->json(['msg' => translate('BookingType deleted successfully'), 'status' => 200]);
    }

    public function form(Request $request)
    {
        $id = $request->id ?? null;
        $booking_type = $id ? BookingType::find($id) : null;

        return view('room_master.booking_type.form', compact('booking_type'));
    }
    public function search_form(Request $request)
    {
        return view('room_master.booking_type.search');
    }

    public function search_results(Request $request)
    {
        $query = BookingType::query();

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $booking_types = $query->paginate(10);
        return view('room_master.booking_type.table', compact('booking_types'))->render();
    }
}
