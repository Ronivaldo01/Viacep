
<?php 
      require_once"viacep.php";
      $address = getAddress();
      require_once"banco.php";
     // var_dump($address);  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumindo API</title>
    <link rel="stylesheet" href="style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>



<body>
    <div class="container">
        
    <!-- Fim da Navbar -->
        <div class="col-sm-6">
            <form action="." method="post">
                <p>Digite o CEP para encontrar o endereço.</p>
                
                <input class="form-control form-control-sm" type="text" placeholder="Digite um cep..." name="cep" value="<?php echo $address->cep; ?>">
                <input class="form-control form-control-sm btn btn-success" type="submit">
                <input class="form-control form-control-sm" type="text" placeholder="rua" name="rua" value="<?php echo $address->logradouro; ?>">
                <input class="form-control form-control-sm" type="text" placeholder="bairro" name="bairro" value="<?php echo $address->bairro; ?>">
                <input class="form-control form-control-sm" type="text" placeholder="cidade" name="cidade" value="<?php echo $address->localidade; ?>">
                <input class="form-control form-control-sm" type="text" placeholder="estado" name="estado" value="<?php echo $address->uf; ?>">
            </form>
        </div>
    </div>
</body>
</html>