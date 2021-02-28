<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function all(Request $request)
    {
        /**
         * The variable for filter data
         * @var id
         * @var limit
         * @var name
         * @var types
         * @var price_from
         * @var price_to
         * @var rate_to
         * @var rate_to
         */

        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $types = $request->input('types');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');


        /**
         * Condition search by ID food
         * @var id
         */
        if($id) {
            $food = Food::find($id);

            if($food) {
                return ResponseFormatter::success(
                    $food,
                    'Data Product found',
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Product not found',
                    404
                );
            }
        } // End Conditiion ID

        // Set dafault query food
        $food = Food::query();

        /**
         * Condition if user add variable filter
         */
        if($name) {
            $food->where('name', 'like', '%'.$name.'%');
        }

        if($types) {
            $food->where('name', 'like', '%'.$name.'%');
        }

        if($price_from) {
            $food->where('price', '>=', $price_from);
        }

        if($price_to) {
            $food->where('price', '<=', $price_to);
        }

        if($rate_from) {
            $food->where('price', '>=', $rate_from);
        }

        if($rate_to) {
            $food->where('price', '<=', $rate_to);
        }

        return ResponseFormatter::success(
            $food->paginate($limit),
            'Data list produk found'
        );
        
    }




}
