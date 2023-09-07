<!DOCTYPE html>
<html>

<head>
    <title>Data Render</title>
    <link href="css\style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container py-2">
        <div class="row">
            <div class="col-10" style="border:1px solid black;">
                <h3><b><u>Product List</u></b></h3>
                <div class="d-flex justify-content-end mb-1">
                    <a href="#" id="btnShow" class="btn btn-primary">Show Products</a>
                </div>
                <table id="tableProduct" class="table table-bordered mb-3">
                    <thead>
                        <tr>
                            <th class="text-center">Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="mb-5">
                    <span id="textResult" class="text-gray"></span>
                </div>
            </div>
        </div>

        <div class="modal  fade" id="modalDetail" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script>
            function getStars(rating) {
                rating = Math.round(rating * 2) / 2;
                let output = [];
                for (var i = rating; i >= 1; i--)
                    output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');
                if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
                for (let i = (5 - rating); i >= 1; i--)
                    output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
                return output.join('');
            }

            function getOrderNumber() {

            }

            function getDateTime() {
                const dt = new Date();
                const padL = (nr, len = 2, chr = `0`) => `${nr}`.padStart(2, chr);
                return (`${dt.getFullYear()}-${padL(dt.getMonth()+1)}-${padL(dt.getDate())} ${padL(dt.getHours())}:${padL(dt.getMinutes())}:${padL(dt.getSeconds())}`);
            }

            $(document).ready(function() {
                $('#btnShow').click(function(event) {
                    $.ajax({
                        dataType: 'json'
                        , url: 'https://dummyjson.com/products'
                        , type: 'GET'
                        , dataType: 'json'
                        , contentType: false
                        , processData: false
                        , success: function(res) {
                            let markup = ''
                            let limit = res.limit;

                            $.each(res.products, function(index, value) {
                                markup += `<tr>
                                            <td><img src="${value.thumbnail}" /></td>
                                            <td>${value.title}</td>
                                            <td>${value.category}</td>
                                            <td>${value.brand}</td>
                                            <td class="text-end">${value.stock}</td>
                                            <td class="text-end text-nowrap">$ ${value.price}</td>
                                            <td><a class="btn btn-primary btn-detail" data-bs-toggle="modal" data-id="${value.id}">View</a></td>
                                        </tr>`;
                            });

                            tableBody = $("#tableProduct tbody")
                            tableBody.empty();
                            tableBody.append(markup)
                            $('#textResult').html(`SHOW: ${limit} ITEMS`)
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });

                $('#tableProduct').on('click', '.btn-detail', function() {
                    const id = $(this).data('id');
                    $.ajax({
                        dataType: 'json'
                        , url: 'https://dummyjson.com/products/' + id
                        , type: 'GET'
                        , dataType: 'json'
                        , contentType: false
                        , processData: false
                        , success: function(res) {
                            console.log(res)
                            const star = getStars(res.rating)
                            $('#modalDetail').modal('show')
                            const modalBody = $('#modalDetail .modal-body');
                            modalBody.empty();
                            const markup = `
                            <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><u>${res.title}</u></h3>
                                    <img class="img image-detail mb-1" src="${res.images[0]}">
                                    <div class="d-flex justify-content-between">
                                        <img class="img image-thumbnail" src="${res.images[1]}">
                                        <img class="img image-thumbnail" src="${res.images[2]}">
                                        <img class="img image-thumbnail" src="${res.images[3]}">
                                        <img class="img image-thumbnail" src="${res.images[4]}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <h3>Price: $${res.price}</h3>
                                        <div id="star">${star}</div>
                                        </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Category: ${res.category}</span>
                                        <span>Brand: ${res.brand}</span>
                                    </div>
                                    <span class="mb-3">Stock: ${res.stock}</span>
                                    <span">Description: </span>
                                    <span class="text-justify mb-3">${res.description}</span>
                                    <form id="formPesan" class="row">
                                        <input type="hidden" name="nm_produk" value="${res.title}" />
                                        <input type="hidden" name="harga" value="${res.price}" />
                                        <div class="col">
                                            <input class="form-control" type="number" value="1" min="1" max="${res.stock}" name="qty" />
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                        </div>
                            `
                            modalBody.append(markup)
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });

                $('#modalDetail').on('submit', '#formPesan', function(e) {
                    e.preventDefault();
                    const waktu = getDateTime();
                    console.log(waktu)

                })
            });

        </script>
</body>

</html>
