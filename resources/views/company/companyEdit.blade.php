<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h2>Company Updating Page</h2>

    <form id="companyUpdatingForm">
        @csrf
        <div class="mb-3">
            <input type="hidden" class="form-control"  name="id" id="id" value={{$company->id}}>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" class="form-control"  name="name" id="name" value={{$company->name}} required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Company Email</label>
            <input type="email" class="form-control"  name="companyEmail" id="companyEmail" value={{$company->companyEmail}} required>
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Company Website</label>
            @if(isset($company->website))
                <input type="text" class="form-control"  name="website" id="website" value={{$company->website}} >
            @else
                <input type="text" class="form-control" name="website" id="website" value="Not Mentioned"> 
            @endif
        </div>

        <button type="button" class="btn btn-primary" name={{$company->id}} onclick="editEmployee(event)">Update</button>
        <a href="/company" class="btn btn-primary">Back</a>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        async function editEmployee(event){
            let formData= new FormData(document.getElementById("companyUpdatingForm"))
            formData.append('_method', 'PUT');
            let id = event.target.name
    
            await fetch("/company/"+id,{
                method:'POST',
                body: formData,
            })
            .then(response=>{return response.json()})
            .then(data=>{
                if(data.msg=="Success"){
                    window.location.href = "/company";
                }
                else if(data.msg=="ValidationFailed"){
                    alert("Information hasn't been added. There was validation errors and check those.")
                    console.log(data.errors)
                }
                else(
                    alert("Information hasn't been updated. Check it thoroughly and try again")
                )
            })


        }
    </script>
</body>
</html>