<!DOCTYPE html>
<html>

<head>
    <title>Data Render</title>
    <link href="css\style.css" rel="stylesheet" />
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
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><u>Iphone 9</u></h3>
                                    <img class="img image-detail" src="https://images.unsplash.com/photo-1489731007795-388eee095ff6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2087&q=80">
                                    <div class="d-flex justify-content-center">
                                        <img class="img image-thumbnail p-1" src="https://images.unsplash.com/photo-1489731007795-388eee095ff6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2087&q=80">
                                        <img class="img image-thumbnail p-1" src="https://images.unsplash.com/photo-1489731007795-388eee095ff6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2087&q=80">
                                        <img class="img image-thumbnail p-1" src="https://images.unsplash.com/photo-1489731007795-388eee095ff6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2087&q=80">
                                        <img class="img image-thumbnail p-1" src="https://images.unsplash.com/photo-1489731007795-388eee095ff6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2087&q=80">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Price: $549</h3>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Category: Smartphone</span>
                                        <span>Brand: Apple</span>
                                    </div>
                                    <span class="mb-3">Stock: 900</span>
                                    <span>Description: </span>
                                    <span class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita saepe quaerat quasi laboriosam incidunt, maxime fuga, quod provident corporis rem perferendis unde atque quas!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script>
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
                                            <td><img src="${value.images[0]}" /></td>
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
                            $('#modalDetail').modal('show')
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });
            });

        </script>
</body>
</html>
