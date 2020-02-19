@extends('layouts.welcome_admin')

@section('content')
<div class="masthead">
  <div class="container h-100">
	<div class="row h-100 align-items-center">
	  <div style="top: 5%;" class="col-12">
		<h1 class="font-weight-bold"><font color="black">COFFEE & TEA FOR YOU</font></h1>
		<p class="lead"><font color="black">A better cup, every day, your way. </font></p>
    <h1><font color="black">Hello Admin</font></h1>
    <div class="container">
        @foreach($orders as $order)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <div class="caption">
              <h3><font color="black">Order Id: {{ $order->orderid }}</font></h3>
              <div><font color="black" size="+1">Total Cost: {{ $order->totalcost }}</font></div>
              <div><font color="black" size="+1">Customer Id: {{ $order->customerid }}</font></div>
              <div><font color="black" size="+1">Customer Username: {{ $order->customerusername }}</font></div>
              <div><font color="black" size="+1">Credit Card Company Name: {{ $order->creditcardcompanyname }}</font></div>
              <form method="post" action={{'deleteOrder'}} accept-charset="UTF-8">
                <input type="hidden"  id="orderid" name="orderid" value="{{ $order->orderid }}" />
                <button type="submit" class="btn btn-primary">Delete Order</button>
                {{ csrf_field() }}
              </form>
              <div><br></br></div>
            </div>
          </div>
        </div>
        @endforeach
		</div>
    </div>
		</div>
	  </div>
	</div>
  </div>
</div>

@endsection
