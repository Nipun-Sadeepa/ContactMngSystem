<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <h2>Welcome to Employee Contacts</h2>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dashboard">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/company">Companies</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/employee/create">Add Employee</a>
                </li>
            </ul>
        </div>  
    </nav>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No</th>
                <th scope="col">Company</th>
                <th scope="col">Updating</th>
                <th scope="col">Deleting</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($employeeList))
                @foreach($employeeList as $employee)
                    <tr id={{$employee->id}} >
                        <td>{{$employee->fName}}</td>
                        <td>{{$employee->lName}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->name}}</td>

                        <td><a href="/employee/{{$employee->id}}/edit/" class="btn btn-primary">Update</a></td>
                        <td><button type="button" class="btn btn-primary" name={{$employee->id}} onclick="deleteEmployee(event)">Delete</button></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $employeeList->links() }}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        async function deleteEmployee(event){
            let id = event.target.name

            await fetch("/deleteEmployee/"+id,{
                method:"GET",
            })
            .then(response=>{return response.json()})
            .then(data=>{
                if(data.msg=="Success"){
                    window.location.href = "/employee";
                }else(
                    alert("Information hasn't been deleted. Check it thoroughly and try again")
                )
            })
        }
    </script>
</body>
</html>