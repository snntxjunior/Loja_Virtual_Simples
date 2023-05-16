<?php 
	session_start();
    if(isset($_GET['limpar'])){
		unset($_SESSION['buy']);//unset -> Destrói a variável especificada
	}



	$camisas = array(
		['name' => 'Feijão', 'image' => 'uploads/image1112.jpg', 'price' => '349.99'],
		['name' => 'Arroz', 'image' => 'uploads/image222.jpg', 'price' => '299.99'],
		['name' => 'Macarrão', 'image' => 'uploads/image333.jpg', 'price' => '249.99']
	);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja do Tio Carlos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-light bg-danger">
	  <div class="container">
	    <a class="navbar-brand" href="#">
	      <img src="images/logo1.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
	    </a>
	  </div>
	</nav>
	
    <div class="card-group text-center container">
		<?php foreach($camisas as $key => $value): ?>
		  <div class="card">
		    <img src="<?= $value['image'] ?>" class="card-img-top" alt="...">
		    <div class="card-body">
		      <h5 class="card-title"><?= $value['name'] ?></h5>
		      <p class="card-text"><?= $value['price'] ?></p>
		      <a href="?comprar=<?php echo $key ?>" class="btn btn-warning">COMPRAR</a>
		    </div>
		  </div>
		<?php endforeach; ?>
        
        <div class="container">
<?php 
	  if(isset($_GET['comprar'])){
	  	$idCamisa = (int) $_GET['comprar'];
	  	if(isset($camisas[$idCamisa])){
	  		if(isset($_SESSION['buy'][$idCamisa])){
	  			$_SESSION['buy'][$idCamisa]['quant']++;
	  		}else{
	  			$_SESSION['buy'][$idCamisa] = array('quant'=>1, 'name'=>$camisas[$idCamisa]['name'], 'price'=>$camisas[$idCamisa]['price']);
	  		}
	  		echo '<script>alert("Camisa adicionada no carrinho")</script>';
	  	}else{
	  		die("O Produto não está mais no estoque");
	  	}
	  }
?>
<h2>Carrinho: </h2>


<?php
	  if(isset($_SESSION['buy'])){
		 foreach ($_SESSION['buy'] as $key => $value){
		  	echo '<p>Nome: '.$value['name'].'| Quant.:'.$value['quant'].' | Valor: R$'.$value['price']*$value['quant'].': ';
		  	echo "<br>";
		  			
		  }
	}
    else{
		  echo "O carrinho está vazio!";
	}

	    $total = [
        'quants' => 0,
        'prices' => 0
     ];
if(isset($_SESSION['buy']))
foreach ($_SESSION['buy'] as $key) {
 $total['quants'] = $total['quants'] + $key['quant']; 
 $total['prices'] = $total['prices'] + $key['price'] * $key['quant']; 
}
echo "<br>";

echo $total['quants']  . ' produtos  por R$ ' . $total['prices'];
?>
<p><a href="?limpar" class="btn btn-secondary">LIMPAR CARRINHO</a></p>



	  </div>

</body>


</html>
