 <!-- Add card details -->
 <div class="row postage-section">
    <div class="col-md-5  mx-auto card-details">
       <form method="post" action ="">
            @csrf
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input 
                type="text" 
                class="form-control" 
                id="cardNumber" 
                placeholder="e.g. 1234 1234 1234 1234">
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="expiryDate" 
                        placeholder="MM/YY">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cvcNumber">CVC Number</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="cvcNumber" 
                        placeholder="CVC">
                    </div>
                </div>
            </div>
       {{--      <div class="form-group">
                <div class="form-check">
                    <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="saveCard">
                    <label class="form-check-label" for="saveCard">
                        Save Card
                    </label>
                </div>
            </div> --}}
            <div class="product-add-to-cart mt-2">
                <button>Pay £{{$order->total_cost}}</button>
            </div>
           
        </form>
    </div>
</div>
