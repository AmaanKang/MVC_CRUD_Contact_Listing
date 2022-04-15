<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h2>We're Sorry, but an error has occured while processing your page.</h2>
    <p class="text-info">Please hit the back button and try that page again.</p>
    <table class="table-bordered bg-warning">
      <tr>
        <td>Time</td>
        <td>SQL Error</td>
        <td>SQl Statement</td>
      </tr>
      <tr>
        <td><?=$error['data']['time']?></td>
        <td><?=$error['data']['mysqlerror']?></td>
        <td><?=$error['data']['sql']?></td>
      </tr>
    </table>
  </div>
</body>
</html>