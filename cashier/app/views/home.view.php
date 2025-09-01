<?php require views_path('partials/header');?> 

<style>
    body{
        background-image: url("assests/images/background.jpg"); /* Light coffee color */

    }
    .hide {
        display: none;
    }
    .bg-coffee {
        background: linear-gradient(to right, #3b2a21, #5c4f43, #7d6c57, #a8947e, #f0e6d2);
        min-height: 100vh; /* Ensure it covers the full height */
    }
   .col-5 {
        background-color: rgba(255, 255, 255, 0.9); /* Light background for both columns */
        border-radius: 10px; /* Rounded corners for a softer look */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    
    }
    .menu-section {
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f5f5dc; /* Light cream for table rows */
    }
    .table-striped tbody tr:nth-of-type(even) {
        background-color: #e1d0c6; /* Light tan for alternating rows */
    }
    .btn{
        background-color: #6f4c3e; /* Dark brown */
        border: none;
    }
    .btn:hover {
        background-color: #5a3e32; 
    }
    .btn-danger {
        background-color: #8b0000; /* Dark red */
        border: none;
    }
</style>

<div class="d-flex p-4">
    <div style="min-height:300px;" class="shadow col-8 p-4 menu-section">
        <div onclick="add_item(event)" class="js-products d-flex" style="flex-wrap: wrap;height: 80%;overflow-y: scroll;"></div>
    </div>

    <div class="col-4 p-4 bg-coffee " style="min-height:600px;">
        <div>
            <center>
                <h3>Orders <div class="js-item-count badge"></div></h3>
            </center>
        </div>

        <div class="table-responsive" style="height: 400px;overflow-y: scroll;">
            <table class="table table-striped table-hover">
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <tbody class="js-items"></tbody>
            </table>
        </div>

        <div class="js-gtotal alert" style="font-size: 30px;color: white;">Total: ₱ 0.00</div>

        <div>
            <button onclick="show_modal('amount_paid')" class="btn my-3 w-100" style="color: white;">Checkout</button>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Enter amount modal -->
<div role="close-button" onclick="hide_modal(event,'amount_paid')" class="js-amount-paid-modal hide" style="background-color: #00000077; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 4;">
    <div style="width: 500px; min-height: 200px; background-color: white; padding: 10px; margin: auto; margin-top: 50px">
        <center><h5>Checkout</h5></center>
        <br>
        <input onkeyup="if(event.keyCode == 13)validate_amount_paid(event)" type="text" class="js-amount-paid-input form-control" placeholder="Enter amount paid">
        <br>
        <button role="close-button" onclick="hide_modal(event,'amount_paid')" class="btn btn-secondary">Cancel</button>
        <button onclick="validate_amount_paid(event)" class="btn btn-primary float-end">Next</button>
    </div>
</div>
<!-- End enter amount modal -->

<!-- Enter change modal -->
<div role="close-button" onclick="hide_modal(event,'change')" class="js-change-modal hide" style="background-color: #00000077; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 4;">
    <div style="width: 500px; min-height: 200px; background-color: white; padding: 10px; margin: auto; margin-top: 50px">
        <center><h5>Change: </h5></center>
        <br>
        <div class="js-change-input form-control text-center" style="font-size: 25px;">0.00</div>
        <br>
        <button role="close-button" onclick="hide_modal(event,'change')" class="js-btn-close-change btn btn-lg btn-secondary float-end">Continue</button>
    </div>
</div>
<!-- End enter change modal -->

 <!-- Supervisor Code Modal -->
<div role="close-button" onclick="hide_modal(event,'supervisor_code')" class="js-supervisor-modal hide" style="background-color: #00000077; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 4;">
    <div style="width: 500px; min-height: 200px; background-color: white; padding: 10px; margin: auto; margin-top: 50px">
        <center><h5>Code Required</h5></center>
        <br>
        <input onkeyup="if(event.keyCode == 13)validate_supervisor_code(event)" type="password" class="js-supervisor-code-input form-control" placeholder="Enter Supervisor Code">
        <br>
        <button role="close-button" onclick="hide_modal(event,'supervisor_code')" class="btn btn-secondary">Cancel</button>
        <button onclick="validate_supervisor_code(event)" class="btn btn-primary float-end">Submit</button>
    </div>
</div>

<!-- End modal -->

<script>

    var PRODUCTS    = [];
    var ITEMS       = [];
    var GTOTAL      = 0;
    var CHANGE      = 0;
    var itemToRemoveIndex = -1;

    function search_item(e){

        var text = e.target.value.trim();
        
        var data = {};
        data.data_type = "search";
        data.text = text;

        send_data(data);

    }

    function send_data(data)
    {
        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange',function(e){

            if(ajax.readyState == 4){

                if(ajax.status == 200)
                {
                    handle_result(ajax.responseText);
                }else{

                    console.log("An error occured. "+ajax.status+" Err message:"+ajax.statusText);
                    console.log(ajax);
                }
            } 
        });

        ajax.open('post','index.php?page_name=ajax',true);
        ajax.send(JSON.stringify(data));
    }

    function handle_result(result){
        //console.log(result);
        var obj = JSON.parse(result);
        
        if(typeof obj != "undefined"){

            if(obj.data_type == "search")
            {
                var mydiv = document.querySelector(".js-products");
                mydiv.innerHTML = "";
                PRODUCTS = [];
                

                if(obj.data != "")
                {
        
                    PRODUCTS = obj.data;
                    for (var i = 0; i < obj.data.length; i++) {
                    
                    mydiv.innerHTML += product_html(obj.data[i],i);
                    }
                }
        
            }
        }

    }
    function product_html(data,index)
    {
        return `
            <!--card-->
            <div class="card m-2 border-0 mx-auto" style="min-width: 100px;max-width: 190px;">
                <a href="#">
                    <img index="${index}" src="${data.image}" class="w-100 rounded" alt="">
                </a>
                <div class="p-2" >
                    <div class="text-muted">${data.description}</div>
                    <div class="" style="font-size: 20px;"><b>₱${data.amount}</b></div>
                </div>
            </div>
                    <!--end card-->
                    `;

    }

    function item_html(data,index)
    {
        return `
            <!--item-->
            <tr>
                <td class="text-muted" >
                    
                    <b>${data.description}</b>
                    <div class="input-group my-3" style="max-width: 150px">
                        <span index="${index}" onclick="change_qty('down',event)" class="input-group-text"><i class="fa fa-minus text-dark" style="cursor: pointer;"></i></span>
                        <input index="${index}" onblur="change_qty('input',event)" type="text" class="form-control" placeholder="1" value="${data.qty}">
                        <span index="${index}" onclick="change_qty('up',event)" class="input-group-text"><i class="fa fa-plus text-dark" style="cursor: pointer;"></i></span>
                    </div>
                </td>
                <td style="font-size: 20px;">
                <b>₱ ${data.amount}</b>
                <button onclick="clear_item(${index})" class="float-end btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
            
                </td>
            </tr>
            <!--end item-->
            `;

    }

    function add_item(e)
    {
        if(e.target.tagName == "IMG"){
            var index = e.target.getAttribute("index");

            for (var i = ITEMS.length - 1; i >= 0; i--){
               
                if(ITEMS[i].id == PRODUCTS[index].id)
                {
                    ITEMS[i].qty += 1;
                    refresh_items_display();
                    return;
                    break;
                }
            }
            var temp = PRODUCTS[index];
            temp.qty = 1;
            ITEMS.push(temp);
            
            refresh_items_display();
        }
    }

    function refresh_items_display()
    {
        var item_count = document.querySelector(".js-item-count");
        item_count.innerHTML = ITEMS.length;

        var items_div = document.querySelector(".js-items");
        items_div.innerHTML = "";
        var grand_total = 0;

        for (var i = ITEMS.length - 1; i >= 0; i--) {
            items_div.innerHTML += item_html(ITEMS[i],i);
            grand_total += (ITEMS[i].qty * ITEMS[i].amount);
            
        }
        var gtotal_div = document.querySelector(".js-gtotal");
        gtotal_div.innerHTML = "Total: ₱" + grand_total.toFixed(2);
        GTOTAL = grand_total;

    }

    function clear_all()
    {
        if(!confirm("Clear Orders"))
            return;

        ITEMS = [];
        refresh_items_display();

    }

    function clear_item(index)
{
   
    itemToRemoveIndex = index;
    show_modal('supervisor_code'); 
}

function validate_supervisor_code(e)
{
    var inputCode = e.currentTarget.parentNode.querySelector(".js-supervisor-code-input").value.trim();
    var supervisorCode = "1234"; // Example supervisor code (you can fetch this from the database or config)

    if (inputCode === supervisorCode) {
        // Code is correct, remove the item
        ITEMS.splice(itemToRemoveIndex, 1);
        refresh_items_display();
        hide_modal(true, 'supervisor_code'); // Close the modal
    } else {
        alert("Incorrect Supervisor Code.");
        document.querySelector(".js-supervisor-code-input").focus(); // Re-focus the input
    }
}
    
    function change_qty(direction,e)
    {
        var index = e.currentTarget.getAttribute("index");
        if(direction == "up")
        {
            ITEMS[index].qty += 1;
        }else
        if(direction == "down")
        {
            ITEMS[index].qty -= 1;
        }else{
            ITEMS[index].qty = parseInt(e.currentTarget.value);
        }

        if(ITEMS[index].qty < 1)
        {
            ITEMS[index].qty = 1;
        }

        refresh_items_display();
    }

    function show_modal(modal)
    {
        if(modal == "amount_paid"){

            if(ITEMS.length == 0){

                alert("Add Order");
                return;
            }
            var mydiv = document.querySelector(".js-amount-paid-modal");
            mydiv.classList.remove("hide");

            mydiv.querySelector(".js-amount-paid-input").value = "";
            mydiv.querySelector(".js-amount-paid-input").focus();
        }else
        if(modal == "change"){

            var mydiv = document.querySelector(".js-change-modal");
            mydiv.classList.remove("hide");

            mydiv.querySelector(".js-change-input").innerHTML = CHANGE;
            mydiv.querySelector(".js-btn-close-change").focus();;

        }else
        if(modal == "supervisor_code"){
        var mydiv = document.querySelector(".js-supervisor-modal");
        mydiv.classList.remove("hide");
        mydiv.querySelector(".js-supervisor-code-input").value = "";
        mydiv.querySelector(".js-supervisor-code-input").focus();
    } 
        
    }

    function hide_modal(e,modal)
    {
        if(e == true || e.target.getAttribute("role") == "close-button")
        {
            if(modal == "amount_paid"){
                var mydiv = document.querySelector(".js-amount-paid-modal");
                mydiv.classList.add("hide");
            }else
            if(modal == "change"){
                var mydiv = document.querySelector(".js-change-modal");
                mydiv.classList.add("hide");
            }else
            if(modal == "supervisor_code"){
            var mydiv = document.querySelector(".js-supervisor-modal");
            mydiv.classList.add("hide");
        } 

        }
        
    }

    function validate_amount_paid(e)
    {
        var amount = e.currentTarget.parentNode.querySelector(".js-amount-paid-input").value.trim();
        
        if(amount == "")
        {
            alert("Enter amount");
            document.querySelector(".js-amount-paid-input").focus();

            return;
        }
        
        amount = parseFloat(amount);
        if(amount < GTOTAL){

            alert("Amount is not valid");
            return;
        }

        CHANGE = amount - GTOTAL;
        hide_modal(true,'amount_paid');
        show_modal('change');

        //remove unwanted info
        var ITEMS_NEW = [];
        for (var i = 0; i < ITEMS.length; i++) {
            
            var tmp = {};
            tmp.id = ITEMS[i]['id'];
            tmp.qty = ITEMS[i]['qty'];
            tmp.description = ITEMS[i]['description'];

            ITEMS_NEW.push(tmp);

        }
        //send cart data to ajax
        send_data({

            data_type:"checkout",
            text:ITEMS_NEW
        });

        //receipt//
        print_receipt({
            company:'Don Machiattos',
            amount:amount,
            change:CHANGE,
            gtotal:GTOTAL,
            data:ITEMS
        });

        //clear items
        ITEMS = [];
        refresh_items_display();

        //reload products
        send_data({

            data_type:"search",
            text:""
        });
    }

    function print_receipt(obj)
    {
        var vars = JSON.stringify(obj);

        window.open('index.php?page_name=print&vars='+vars,'printpage',"width=300px;");
    }
    
    send_data({

        data_type:"search",
        text:""
    });
</script>
    
<?php require views_path('partials/footer');?>
    
    
