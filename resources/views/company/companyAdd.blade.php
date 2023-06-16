<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <form id="companyForm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" class="form-control"  name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Company Email</label>
            <input type="email" class="form-control"  name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Company Website</label>
            <input type="text" class="form-control"  name="website" id="website">
        </div>

        <button type="button" class="btn btn-primary" onclick="addCompany()">Add Company</button>
        <a href="/company" class="btn btn-primary">Back</a>
    </form>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        function addCompany(){
            const formData = new FormData(document.getElementById('companyForm'));

            fetch("/company", {
                method: "POST",
                body: formData,
            })
            .then(response=>{return response.json()})
            .then(data=>{
                if(data.msg=="Success"){
                    alert("Information has been added.")
                    window.location.href = "/company/create";
                }
                else if(data.msg=="ValidationFailed"){
                    alert("Information hasn't been added. There was validation errors and check those.")
                    console.log(data.errors)
                }
                else(
                    alert("Information hasn't been added. Check it thoroughly and try again.")
                )
            })
         }
    </script>
</body>
</html>