<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <form id="employeeForm">
        @csrf
        <div class="mb-3">
            <label for="fName" class="form-label">First Name</label>
            <input type="text" class="form-control"  name="fName" id="fName" required>
        </div>
        <div class="mb-3">
            <label for="lName" class="form-label">Last Name</label>
            <input type="text" class="form-control"  name="lName" id="lName" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control"  name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Contact No</label>
            <input type="tel" class="form-control"  name="phone" id="phone" pattern="[0-9]{10}" required>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="companyDropdown">Company</label>
            <select class="form-select" id="companyDropdown" name="companyDropdown" pattern="[0-9]{10}" required>
                <option selected disabled>Select Company</option>
                @isset($companyList)
                @foreach($companyList as $company)
                    <option value={{$company->id}}>{{$company->name}}</option required>
                @endforeach
                @endisset
            </select>
        </div>

        <button type="button" class="btn btn-primary" onclick="addEmployee()">Add Employee</button>
        <a href="/employee" class="btn btn-primary">Back</a>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        async function addEmployee(){
            const formData = new FormData(document.getElementById('employeeForm'));
            
            await fetch("/employee", {
                method: "POST",
                body: formData,
            })
            .then(response=>{return response.json()})
            .then(data=>{
                if(data.msg=="Success"){
                    alert("Information has been added.")
                    window.location.href = "/employee/create";
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