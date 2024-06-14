<title>Edition devis</title>

<div class="container">
    <h3 class="text-center text-uppercase"><?= $estimate->getNameEstimate(); ?></h3>
    <input type="hidden" id="taskQuantity" value="<?= count($tasksList) ?>">
    <input type="hidden" id="rowCount" value="<?= $rowCount ?>">
    <form method="post" action="<?= BASE_URL . 'modifyEstimate'; ?>">
        <input type="hidden" id="controlUpdate" name="controlUpdate" value="update">
        <input type="hidden" name="idEstimate" value="<?= $estimate->getId() ?>">
        <div class="blockList">
            <?php
            var_dump($tasksList);
            if (!empty($tasksList)) {

                foreach ($tasksList as $taskDetails) {
            ?>
                    <div class="py-2 block<?= $taskDetails['taskNumber'] ?>" name="lineNb<?= $taskDetails['taskNumber'] ?>">
                        <input type="hidden" class="blocNb" name="taskNumber<?= $taskDetails['taskNumber'] ?>" value="<?= $taskDetails['taskNumber'] ?>">
                        <label for="description" class="fs-5 fw-bold">Description</label>
                        <textarea rows="2" class="form-control description" name="description<?= $taskDetails['taskNumber'] ?>"><?= $taskDetails['descriptionTask'] ?></textarea>
                        <div class="table-responsive">
                            <table class="text-center table table<?= $taskDetails['taskNumber'] ?> table-striped">
                                <thead class="vertical-align">
                                    <tr>
                                        <th>Type</th>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Montant total</th>
                                    </tr>
                                </thead>

                                <tbody class="task<?= $taskDetails['taskNumber'] ?>">
                                    <?php
                                    $productsByTask = $taskManager->getProductsByTask($taskDetails['id']);
                                    foreach ($productsByTask as $productByTask) {
                                        $testproduct = $productsManager->getProductsById($productByTask->getIdProduct());
                                    ?>
                                        <tr class="rowId row<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>" style="min-width: 95px" id="<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>">
                                            <input type="hidden" class="rowNb" name="row<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getRow() ?>">
                                            <td>
                                                <select class="form-select type" id="type" aria-label="Default select example">
                                                    <option class="active">SELECTION</option>
                                                    <?php foreach ($typesList as $type) { ?>
                                                        <option class="" data-setType="<?= $type->getId() ?>" value="<?= $type->getName() ?>" <?php
                                                                                                                                                if ($type->getName() == $testproduct->getType()) {
                                                                                                                                                    echo 'selected';
                                                                                                                                                } ?>><?= $type->getName() ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select product" style="min-width: 95px;" aria-label="Default select example" name="product<?= $taskDetails['taskNumber'] ?>[]">
                                                    <option class="active">SELECTION</option>
                                                    <?php
                                                    foreach ($productList as $type => $product) {
                                                    ?>
                                                        <option hidden class="<?= $product->getType() ?>" data-getType="<?= $product->getType() ?>" data-getUnit="<?= $product->getUnit() ?>" data-getPrice="<?= $product->getPrice() ?>" value="<?= $product->getName() ?>" <?php
                                                                                                                                                                                                                                                                                if ($product->getName() == $testproduct->getName()) {
                                                                                                                                                                                                                                                                                    echo 'selected';
                                                                                                                                                                                                                                                                                } ?>><?= $product->getName() ?>
                                                        </option>

                                                    <?php

                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="currency-wrap">
                                                    <span class="currency-code unit"><?= $productByTask->getUnit() ?></span>
                                                    <input type="hidden" class="unitName" name="unit<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getUnit() ?>">
                                                    <input class="form-control quantity text-center" style="min-width: 40px" name="quantity<?= $taskDetails['taskNumber'] ?>[]" type="number" onkeydown="return event.keyCode !== 69" value="<?= $productByTask->getQuantityProduct() ?>" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="currency-wrap">
                                                    <span class="currency-code">€</span>
                                                    <input class="form-control unitPrice text-center" style="min-width: 40px" name="unitPrice<?= $taskDetails['taskNumber'] ?>[]" type="number" onkeydown="return event.keyCode !== 69" step="any" id="unitPrice" value="<?= $productByTask->getUnitPriceProduct() ?>" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="currency-wrap">
                                                    <span class="currency-code">€</span>
                                                    <div type="number" onkeydown="return event.keyCode !== 69" step="any" style="min-width: 40px;" data-type="currency" class="resultPrice text-center"><?= $productByTask->getQuantityProduct() * $productByTask->getUnitPriceProduct() ?></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="remove">X</div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input type=" button" class="btn btn-success addLineBlock<?= $taskDetails['taskNumber'] ?>" value="Ajouter ligne" id="addLineBlock<?= $taskDetails['taskNumber'] ?>" onclick="addLine('.row', <?= $taskDetails['taskNumber'] ?>)" />
                        <hr class="border border-primary border-1 opacity-100">
                    </div>
            <?php
                }
            }
            require_once APP_PATH . "/views/blockModel.php";
            ?>
        </div>
        <input type="button" class="btn btn-success addBlock" value="Ajouter bloc" />
        <div class="container text-end">
            <input type="submit" value="Enregistrer devis" class="btn btn-primary">
        </div>
    </form>

    <h5 class="resultPriceTotal"></h5>
</div>
<script src="JS/createEstimateScript.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";
?>