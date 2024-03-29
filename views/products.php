<?php
define("BASE_URL", "/EYOSOP");
require_once "./head.php";
?>

<title>Rouleaux</title>

<?php
require_once "./header.php";
require_once "../controller/productsManager.php";

$productsManager = new ProductsManager();
if ($_POST) {
    $name = $_POST["name"];
    $length = $_POST["length"];
    $recovery = $_POST["recovery"];
    $summary = $_POST["summary"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    try {
        $newProduct = new Products([
            "name" => $name,
            "length" => $length,
            "recovery" => $recovery,
            "summary" => $summary,
            "description" => $description,
            "price" => $price,
        ]);
        $productsManager->addProducts($newProduct);
        echo "L'ajout a réussi.";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<form method="post" class="container">
    <label class="form-label" for="name">Nom / Ref</label>
    <input type="name" name="name" id="name" class="form-control" min=1 max=901 placeholder="Référence du rouleau">
    <label class="form-label" for="length">Longueur</label>
    <input type="number" name="length" id="length" class="form-control" placeholder="Longueur du rouleau en m">
    <label class="form-label" for="recovery">Recouvrement</label>
    <input type="number" name="recovery" id="recovery" class="form-control" placeholder="Le recouvrement longitudinal en mm"></input>
    <label class="form-label" for="summary">Résumé</label>
    <input type="text" name="summary" id="summary" class="form-control" placeholder="Résumé succint concernant le rouleau"></input>
    <label class="form-label" for="description">Description</label>
    <input type="text" name="description" id="description" class="form-control" placeholder="Description/destination du rouleau"></input>
    <label class="form-label" for="price">Prix</label>
    <input type="text" name="price" id="price" class="form-control" placeholder="Prix au m²"></input>
    <input type="submit" value="Créer" class="btn btn-success mt-3">
</form>

<div class="container">
    <section class="d-flex flex-wrap justify-content-center">
        <?php
        $products = $productsManager->showProducts();
        foreach ($products as $product) :
        ?>
            <div class="card m-4" style="width: 20rem;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title"><?= $product->getName() ?></h5>
                    <p class="card-text"><?= $product->getSummary() ?></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Prix : <?= $product->getPrice() ?> €/m²</li>
                    </ul>
                    <div class="">
                        <a href="../views/detailsProducts.php?id=<?= $product->getId() ?>" class="btn btn-primary">Détails</a>
                        <a href="../views/modifyProducts.php?id=<?= $product->getId() ?>" class="btn btn-warning">Modifier</a>
                        <a href="../views/deleteProducts.php?id=<?= $product->getId() ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</div>

<?php
require_once "../views/footer.php";
