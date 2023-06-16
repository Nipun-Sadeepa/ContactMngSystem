<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h2>Welcome to Company Contacts</h2>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dashboard">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/employee">Employees</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/company/create">Add Company</a>
                </li>
            </ul>
        </div>  
    </nav>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Website</th>
                <th scope="col">Updating</th>
                <th scope="col">Deleting</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($companyList))
                @foreach($companyList as $company)
                    <tr id={{$company->id}} >
                        <td>{{$company->name}}</td>
                        <td>{{$company->companyEmail}}</td>
                        <td>@isset($company->website)
                                {{$company->website}}
                            @else
                                Not Mentioned
                            @endisset
                        </td>
                        <td><a href="/company/{{$company->id}}/edit/" class="btn btn-primary">Update</a></td>
                        <td><button type="button" class="btn btn-primary" name={{$company->id}} onclick="deleteCompany(event)">Delete</button></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $companyList->links() }}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>

        async function deleteCompany(event){
            let id= event.target.name
            await fetch("/deleteCompany/"+id,{
                method:"GET",
            })
            .then(response=>{return response.json()})
            .then(data=>{
                if(data.msg=="Success"){
                    window.location.href = "/company";
                }else(
                    alert("Information hasn't been deleted. Check it thoroughly and try again")
                )
            })
        }
    </script>
</body>
</html>