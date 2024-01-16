<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>本の評価アンケート</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>本の評価アンケート</h1>
        <form method="post" action="process_input.php">
            <div class="form-group">
                <label for="name">名前：</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email：</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label>本の評価：</label>
                <div>
                    <button type="button" class="btn btn-rating" value="1"><i class="fas fa-star"></i></button>
                    <button type="button" class="btn btn-rating" value="2"><i class="fas fa-star"></i></button>
                    <button type="button" class="btn btn-rating" value="3"><i class="fas fa-star"></i></button>
                    <button type="button" class="btn btn-rating" value="4"><i class="fas fa-star"></i></button>
                    <button type="button" class="btn btn-rating" value="5"><i class="fas fa-star"></i></button>
                    <input type="hidden" name="rating" id="rating" value="0">
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="送信">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.btn-rating').click(function(){
                var rating = $(this).val();
                $('#rating').val(rating);

                $('.btn-rating').removeClass('btn-warning');
                $('.btn-rating').slice(0, rating).addClass('btn-warning');
            });
        });
    </script>
</body>
</html>
