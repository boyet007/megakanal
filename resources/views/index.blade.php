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
            <div class="col-8" style="border:1px solid black;">
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
                                            <td><a class="btn btn-primary">View</a></td>
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
        });

    </script>
</body>
</html>
