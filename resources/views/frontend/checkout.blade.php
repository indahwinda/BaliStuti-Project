@extends('layouts.front')

@section('title');
    Checkout
@endsection

@section('content')
    <div class="container-fluid mt-5 mb-5">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h3>Basic Details</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Full Name" value="{{Auth::user()->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone Number" value="{{Auth::user()->phone}}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Address</label>
                                    <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address" rows="3">{{Auth::user()->address}}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @php
                                    $address = Auth::user()->address;
                                    $result_explode = explode(',', $address);
                                    // echo "Address: ". $result_explode[0]."<br />";
                                    // echo "Pos: ". $result_explode[1]."<br />";
                                    // echo "Kabupaten/Kota: ". $result_explode[2]."<br />";
                                    // echo "Provinsi: ". $result_explode[3]."<br />";

                                @endphp 
                                <div class="col-md-6">
                                    <label for="">Pos Code</label>
                                    <input type="text"  class="form-control  @error('pos_code') is-invalid @enderror" name="pos_code" id="pos_code" placeholder="Pos Code" value="@if (isset($result_explode[array_key_last($result_explode)] )) {{$result_explode[array_key_last($result_explode)]}} @endif">
                                    @error('pos_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <h3>DESTINATION</h3>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-weight-bold">DESTINATION PROVINCE</label>
                                        <select class="form-control provinsi-tujuan kurir  @error('province_destination') is-invalid @enderror" name="province_destination" id="province_destination">
                                            <option value="0">-- select destination province  --</option>
                                            @foreach ($provinces as $province => $value)
                                                <option value="{{ $province  }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_destination')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror   
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold  @error('city_destination') is-invalid @enderror"> DESTINATION CITY / REGENCY</label>
                                        <select class="form-control kota-tujuan kurir check" id="city_destination" name="city_destination" disabled>
                                            <option value="" >-- select destination city--</option>
                                        </select>
                                        @error('city_destination')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror       
                                    </div>     
                                </div>
                                <div class="col-md-12">
                                    <h3>COURIER</h3>
                                    <hr>
                                    {{-- <div class="form-group">
                                        <label class="font-weight-bold">SELECT AVAILABLE COURIER</label>
                                        <select class="form-control kurir  @error('courier') is-invalid @enderror" id="courier" name="courier" >
                                            <option value="0" selected>-- select courier --</option>
                                            <option class="check" value="jne">JNE</option>
                                            <option class="check" value="pos">POS</option>
                                            <option class="check" value="tiki">TIKI</option>
                                        </select>
                                        @error('courier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>            --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card d-none ongkir">
                                        <div class="card-body">
                                            <label for="">Select Delivery</label>
                                            <select class="form-control kurir" name="delivery" id="ongkir">
                                                <option value="0">-- select delivery --</option>
                                            </select>
                                            @error('delivery')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h3>Order Summary</h3>
                            <hr>
                            @php
                                $total = 0;
                                $total_weight = 0;
                                $sub_weight = 0;
                            @endphp
                            @foreach ($cartItems as $item )
                                <div class="row p-0">
                                    <div class="col-md-3">
                                        <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                        <img src="{{asset("assets/upload/product/".$item->product->image)}}" alt="" width="80px">
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{ $item->product->name }}</p>
                                        <small>{{ $item->product_qty }} items x Rp{{number_format($item->product->selling_price,2,',','.')}}</small><br>
                                        @php
                                            $sub_weight = $item->product->weight * $item->product_qty;
                                        @endphp
                                        <small>{{ $sub_weight }} gram</small>
                                    </div>
                                    <div class="col-md-5">
                                        <b>Subtotal</b>
                                        <p>Rp{{number_format($item->product->selling_price * $item->product_qty,2,',','.')}}</p>
                                    </div>
                                </div>
                                @php
                                    $total += $item->product->selling_price * $item->product_qty;
                                    $total_weight += $sub_weight;
                                @endphp
                                <hr>
                            @endforeach
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Delivery Fee</p>
                                    <small class="ongkir-final">-</small>
                                </div>
                                <div class="col-md-6">
                                    <p>Total</p>
                                    <small id="total-biaya">Rp{{number_format($total,2,',','.')}}</small>
                                </div>
                            </div>
                            <hr>
                            <h5>Total FInal</h5>
                            <b class="total-final">-</b>
                            <div class="text-right mt-3">
                                <button type="submit" id="submit" class="btn btn-primary text-right">Proceed to Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $(document).ready(function(){

       
        //active select2
        $(".provinsi-tujuan, .kota-tujuan").select2({
            theme:'bootstrap4'
        });
        $(".kota-tujuan").select2({
            theme:'bootstrap4',
            containerCssClass : "check" 
        });

        $("#edit").on("show.bs.modal", function (e) {
            var ongkir = $(e.relatedTarget).data('ongkir');
        });
        
        //ajax select kota tujuan
        $('select[name="province_destination"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').prop('disabled',false);
                        $('select[name="city_destination"]').append('<option value="" class="check">-- select destination city --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_destination"]').append('<option value="' + key + '" class="check">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append('<option value="">-- select destination city --</option>');
            }
        });
        //ajax check ongkir
        let isProcessing = false;
        // $('select[name="courier"]').on('change', function (e) {
        $('.check').on('change', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Please wait',
                html: 'Looking for the best delivery service',
                timer: 4000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $( "#ongkir" ).click();
                    }
            })

            let token            = $("meta[name='csrf-token']").attr("content");
            let city_destination = $('select[name=city_destination]').val();
            // let courier          = $('select[name=courier]').val();
            let weight           = "<?php echo $total_weight; ?>";
            if(isProcessing){
                return;
            }
            isProcessing = true;
            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token:              token,
                    city_destination:    city_destination,
                    // courier:             courier,
                    weight:              weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        for (let i = 0; i <3; i++) {
                            $.each(response[i]['costs'], function (key, value) {
                                const rupiah = new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.cost[0].value);
                                $('#ongkir').append('<option class="form-control ongkir-total ambil-data" data-ongkir="'+value.cost[0].value+'" data-courier ="'+response[i].code.toUpperCase()+"("+value.service+")"+'" value="'+value.cost[0].value+'" >'+response[i].code.toUpperCase()+' : <strong>'+value.service+'</strong> - '+rupiah+' ('+value.cost[0].etd+' days)</option>')
                            });
                        }
                        $( "#ongkir" ).click();
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>'
                        });
                    }
                }
            });

        });
        $('.kurir').on('click', function (e) {
            e.preventDefault();
            // let ongkir = $(e.relatedTarget).data('ongkir');
            let ongkir = $('#ongkir').find(':selected').data('ongkir');
            let total_biaya = "<?php echo $total; ?>";
            const rupiahOngkir = new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(ongkir);
            $('.ongkir-final').text(rupiahOngkir);
            $('#courier_ongkos').val(ongkir);
            let total_final = parseInt(ongkir) + parseInt(total_biaya);
            $('#total_orders').val(total_final);
            const rupiah = new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(total_final);
            $('.total-final').text(rupiah);
            $('#total-final-hidden').val(total_final);
            var courier = $(e.relatedTarget).data('courier');
        });

        $('#submit').on('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Checking...',
                html: 'Please wait',
                timer: 4000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    
                },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                       
                    }
            })
            let ongkir = $('#ongkir').find(':selected').data('ongkir');
            let total_biaya = "<?php echo $total; ?>";
            let total_final = parseInt(ongkir) + parseInt(total_biaya);
            var courier = $('#ongkir').find(':selected').data('courier');
            var name = $('#name').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var province_destination = $('#province_destination').val();
            var city_destination = $('#city_destination').val();
            var pos_code = $('#pos_code').val();
            var total_orders = total_final;
            $.ajax({
                method: "POST",
                url: "/place-order",
                data: {
                    _token:             "{{ csrf_token() }}",
                    name:                name,
                    phone:               phone,
                    address:             address,
                    province_destination:province_destination,
                    city_destination:    city_destination,
                    pos_code:            pos_code,
                    courier:             courier,
                    courier_ongkos:      ongkir,
                    total_orders:        total_orders,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Your order has been placed',
                        });
                        setTimeout(function() {
                                window.location.href = "view-payment";
                        }, 500);
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>'
                        });
                    }
                }
            });

        });

    });
</script>

@endsection