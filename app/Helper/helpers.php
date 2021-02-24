<?php
//auto loaded helper functions for api and web routes

if(!function_exists('success')){
    function success($data = [], $message = '', $headers = [], $code = 200){
        $header['Content-type'] = 'Application/json';
        $header['Accept'] = 'Application/json';
        if(!empty($headers)){
            foreach($headers as $key => $value){
                $header[$key] = $value;
            }
        }

        $response = response()->json([
            'status' => true,
            'message' => $message,
            'data'  => $data
        ], $code)->withHeaders($header);

        return $response;
    }
}

if(!function_exists('error')){
    function error($message = '', $code = 200 ){
        header('Content-type: Application/json');
        return response()->json([
            'status' => false,
            'message'   => $message
        ], $code);
    }
}

if(!function_exists('setting')){
    function setting($key){
        $setting = App\Models\Setting::where('key', $key)->first();
        return $setting->value??'';
    }
}

if(!function_exists('imageUploader')){
    
    function imageUploader($image, $storage = 'logo', $type = 'u'){

        if($type == 'u'):
            
            $path = $storage.'/'. time().'_'.rand(1, 100) . '.' . $image->getClientOriginalExtension();

            Illuminate\Support\Facades\Storage::disk('public')->put($path, file_get_contents($image));

            return $path;
        
        else:

            $path = $storage.'/'.basename($image);
            
            if(file_exists($path)){
                Illuminate\Support\Facades\Storage::disk('public')->delete($path);
            }

        endif;
    }
}

if(!function_exists('recentUsers')){
    function recentUsers(){
        return App\User::orderBy('updated_at', 'desc')->limit(20)->get();
    }
}

if(!function_exists('recentOrders')){
    function recentOrders($status = 'progress'){
        return App\Models\Order::orderBy('updated_at', 'desc')->where('status', $status)->limit(100)->get();
    }
}

if(!function_exists('calcTotal')){
    function calcTotal(App\Models\Order $order = null, $type = 'order'){
        if($type == 'all'){
            return App\Models\OrderProduct::whereHas('order', function($order){
                $order->where('status', 'delivered')
                ->where('payment_status', true)
                ;
            })->sum('total_price');
        }

        return App\Models\OrderProduct::where('order_id', $order->id)->sum('total_price');
    }
}

if(!function_exists('orderSummary')){
    function orderSummary($type = 'count'){
        $order = App\Models\Order::query();
        if($type == 'count'){
            return $order->where('status', 'progress')->count();
        }
    }
}

if(!function_exists('userSummary')){
    function userSummary($type = 'count'){
        $user = App\User::query();
        if($type == 'count'){
            return $user->count();
        }
    }
}

if(!function_exists('isroute')){
    function isroute($route, $open = false){
        if(Route::currentRouteName() == $route):
            if($open):
                echo 'menu-is-opening menu-open';
            else:
                echo 'active';
            endif;
        endif;
    }
}

if(!function_exists('getPaginationData')){
    function getPaginationData($arrayData){
        $perPage = request('per_page')??10;
        $currentPage = Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($arrayData->all(), $perPage * ($currentPage - 1), $perPage);
        $results = new Illuminate\Pagination\LengthAwarePaginator($currentItems, count($arrayData->all()), $perPage, $currentPage, ['path' => Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath()]);
        $results = $results->appends('search', request('search'));
        $results = $results->appends('per_page', request('per_page'));
        $results = $results->appends('type', request('type'));
        return $results;
    }
}

if(!function_exists('paidStatus')){
    function paidStatus($status = false){
        if($status):
            echo "Paid";
        else:
            echo '<span class="badge badge-danger"><i class="fas fa-times"></i></span> Unpaid';
        endif;
    }
}