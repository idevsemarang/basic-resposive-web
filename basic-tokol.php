<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Basic Bom</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        body{
            padding: 10px;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
        }

        .single-product{
            /* border: 1px solid #e9ecef; */
        }
        .single-product:hover{
            opacity: 0.8;
            cursor: pointer;
        }

        .single-product img{
            width: 100%;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .product-label{
            padding: 6px;
            background: #ffffff;
        }
        .category-single{
            background-color: #ffffff;
            border-radius: 8px;
            padding: 10px 10px;
        }
        .category-single.active{
            background-color: #2C6380;
            color: #ffffff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) 
        }
    </style>
</head>

<body>

    <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
            <h4>Kategori</h4>
            <div class="row mb-4 mt-2 section-categories"></div>

            <h4>Semua Produk</h4>
            <div class="row section-products"></div>
        </div>

        <div class="col-12 col-md-4 col-lg-4">
            <div class="card border-0">
                <div class="card-header text-white" style="background-color: #2C6380;">
                    <h5>Histori Order</h5>
                </div>
                <div class="card-body">
                    <table class="table table-stripped table-history">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <h6 class="text-center subtotal-price">TOTAL Rp 0</h6>

                    <button class="btn btn-danger w-100 my-2">Checkout</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalBuy" tabindex="-1" aria-labelledby="modalBuyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBuyLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="">Quantity</label>
                    <input type="number" name="" id="input-qty" class="form-control">
                    <input type="hidden" name="" id="input-code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addItem()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/fontawesome.js"></script>

    <script>
        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
            }).format(number).replace(",00", "");
        }

        var categories = [
            {
                name : 'Semua',
                icon : 'fa fa-boxes',
                flagActive : true,
            },
            {
                name : 'Kebersihan',
                icon : 'fa fa-broom',
                flagActive : false,
            },
            {
                name : 'Teknologi',
                icon : 'fa fa-laptop',
                flagActive : false,
            },
            {
                name : 'Pendidikan',
                icon : 'fa fa-book',
                flagActive : false,
            },
            {
                name : 'Bangunan',
                icon : 'fa fa-building',
                flagActive : false,
            },
            {
                name : 'Lain-lain',
                icon : 'fa fa-cube',
                flagActive : false,
            },
        ]

        var products = [
            {
                code: 1, 
                name : 'Kipas Angin', 
                image : 'https://media.dinomarket.com/docs/imgTD/2021-10/DM_92204753CD21ACCABEF6D709A75FA6E2_181021131021_ll.jpg.jpg',
                price: 200000, 
                stock : 100
            },
            {
                code: 2, 
                name : 'Sepatu', 
                image : 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//107/MTA-47597525/brd-44261_sepatu-sneakers-olahraga-pria-model-tali_full01.jpg',
                price: 500000, 
                stock : 130
            },
            {
                code: 3, 
                name : 'Boneka', 
                image : 'https://down-id.img.susercontent.com/file/id-11134207-7r98x-lmx1gj67ub9od4',
                price: 130000, 
                stock : 210
            },
            {
                code: 4, 
                name : 'Gelas Keren', 
                image : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqlGzOvoz6QMEqGOh63s3U2FspxU4jVBAsWQ&usqp=CAU',
                price: 40000, 
                stock : 710
            },
            {
                code: 5, 
                name : 'Sapu Lantai', 
                image : 'https://p-id.ipricegroup.com/5feababe0ee4538334626cebda6ce52fc835823e_0.jpg',
                price: 10000, 
                stock : 80
            },
            {
                code: 6, 
                name : 'Topi', 
                image : 'https://upload.jaknot.com/2023/02/images/products/50d7bf/original/flb-topi-baseball-motif-polkadot-sporty-hat-mz237.jpg',
                price: 20000, 
                stock : 100
            },
            {
                code: 7, 
                name : 'Jeans Wanita', 
                image : 'https://img.lazcdn.com/g/p/9ec42e1e6bce89fbdbdf5bf48583cc89.jpg_720x720q80.jpg',
                price: 209000, 
                stock : 300
            },
            {
                code: 7, 
                name : 'Kacamata Korea', 
                image : 'https://img.lazcdn.com/g/p/9e24b2ae1dab85456c9e121c2c6cec54.jpg_720x720q80.jpgg',
                price: 192000, 
                stock : 90
            },
            
        ]

        var productHistories = []

        viewProducts()
        viewCategories()

        function viewCategories() {
            var mHtml = ""
            $.each( categories, function( i, category ) {
                var flagActive = ""
                if(category.flagActive){
                    flagActive = "active"
                }

                mHtml += "<div class='col-md-3 col-6 col-lg-2'>"
                mHtml += "<div class='category-single my-1 "+flagActive+"'>"
                mHtml += "<i class='"+category.icon+"'></i> <label>"+category.name+"</label>"
                mHtml += "</div>"
                mHtml += "</div>"
            });

            $(".section-categories").html(mHtml)
        }

        function viewProducts() {
            var mHtml = ""
            $.each( products, function( i, product ) {
                mHtml += "<div class='col-md-3 col-6 col-lg-3'>"
                mHtml += "<div class='single-product my-2'  data-bs-toggle='modal' data-bs-target='#modalBuy' onclick='setModalBuy("+product.code+")'>"
                mHtml += "<img src='"+product.image+"'>"
                mHtml += "<div class='product-label'>"
                mHtml += "<h6>"+product.name+"</h6>"
                mHtml += "<label>"+rupiah(product.price)+"</label><br>"
                mHtml += "<label>Stock <b>"+product.stock+"</b></label>"
                mHtml += "</div>"
                mHtml += "</div>"
                mHtml += "</div>"
            });

            $(".section-products").html(mHtml)
        }

        function getProductByCode(code) {
            return products.find(product => product.code == code);
        }

        function getProductHistoriesByCode(transcode) {
            return productHistories.find(ph => ph.transcode == transcode);
        }

        function setModalBuy(code)
        {
            const product = getProductByCode(code)

            $(".modal-title").text(product.name)
            $("#input-code").val(product.code)
            $("#input-qty").val("")
        }

        function formatDateTime(currentTimestamp)
        {
            const currentDate = new Date(currentTimestamp);
            var year = currentDate.getFullYear();
            var month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed, so we add 1
            var day = String(currentDate.getDate()).padStart(2, '0');
            var hours = String(currentDate.getHours()).padStart(2, '0');
            var minutes = String(currentDate.getMinutes()).padStart(2, '0');
            var seconds = String(currentDate.getSeconds()).padStart(2, '0');
            var formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

            return formattedDateTime
        }

        function addItem()
        {
            const currentTimestamp = Date.now();                        
            const code = $("#input-code").val()
            const qty = $("#input-qty").val()
            const product = getProductByCode(code)
            const totalPrice = qty*product.price
            const currentStock = product.stock
            const stockRemain = currentStock - qty
            var formattedDateTime = formatDateTime(currentTimestamp)

            product.stock = stockRemain
            viewProducts()
            
            $(".modal").modal('hide')

            productHistories.push({
                transcode: currentTimestamp, 
                transdate: formattedDateTime, 
                code : code, 
                name : product.name, 
                qty : qty,
                price : totalPrice,
            })

            viewProductHistories()
        }

        function viewProductHistories()
        {
            var countTotalPrice = 0
            var mHtml = ""
            $.each( productHistories, function( i, ph ) {
                mHtml += "<tr class='item-"+ph.transcode+"'>"
                mHtml += "<td>"+ph.name+"</td>" //<br><small>At "+ph.transdate+"</small></td>"
                mHtml += "<td>"+ph.qty+"</td>"
                mHtml += "<td>"+rupiah(ph.price)+"</td>"
                mHtml += "<td><button class='btn btn-sm btn-danger' title='Hapus item' onclick=removeItem("+ph.transcode+")> <i class='fa fa-trash'></i> </button></td>"
                mHtml += "</tr>"

                countTotalPrice += ph.price
            });
            $(".table-history tbody").html(mHtml)

            $(".subtotal-price").text("TOTAL "+rupiah(countTotalPrice))
        }

        function removeItem(transcode) 
        {
            const ph = getProductHistoriesByCode(transcode)
            const index = productHistories.findIndex(ph => ph.transcode == transcode);

            if (index !== -1) {
                productHistories.splice(index, 1);
                viewProductHistories()

                // return back stock
                const product = getProductByCode(ph.code)
                const currentStock = product.stock
                const stockRemain = parseInt(currentStock) + parseInt(ph.qty)

                product.stock = stockRemain

                viewProducts()
            } 
        }

    </script>
</body>

</html>