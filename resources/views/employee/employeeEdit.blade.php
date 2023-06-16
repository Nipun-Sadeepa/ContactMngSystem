<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h2>Employee Updating Page</h2>

    <form id="employeeUpdatingForm">
        @csrf
        <div class="mb-3">
            <input type="hidden" class="form-control"  name="id" id="id" value={{$employee->id}}>
        </div>
        <div class="mb-3">
            <label for="fName" class="form-label">First Name</label>
            <input type="text" class="form-control"  name="fName" id="fName" value={{$employee->fName}} required>
        </div>
        <div class="mb-3">
            <label for="lName" class="form-label">Last Name</label>
            <input type="text" class="form-control"  name="lName" id="lName" value={{$employee->lName}} required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control"  name="email" id="email" value={{$employee->email}} required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Contact No</label>
            <input type="tel" class="form-control"  name="phone" id="phone" pattern="[0-9]{10}" value={{$employee->phone}} required>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="companiesId">Company</label>
            <select class="form-select" id="companiesId" name="companiesId">
                @foreach($companyList as $company)
                    @if($company->id == $employee->companiesId)
                        <option value={{$company->id}} selected>{{$company->name}}</option>
                    @else
                        <option value={{$company->id}}>{{$company->name}}</option>  
                    @endif
                @endforeach
            </select>
        </div>

        <button type="button" class="btn btn-primary" name={{$employee->id}} onclick="editEmployee(event)">Update</button>
        <a href="/employee" class="btn btn-primary">Back</a>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        async function editEmployee(event){
            let formData= new FormData(document.getElementById("employeeUpdatingForm"))
            formData.append('_method', 'PUT');
            let id = event.target.name
    
            await fetch("/employee/"+id,{
                method:'POST',
                body: formData,
            })
            .then(response=>{return response.json()})
            .then(data=>{
                if(data.msg=="Success"){
                    window.location.href = "/employee";
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