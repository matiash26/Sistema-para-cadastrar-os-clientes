<?php
require_once "top.php";
require_once "modules/historico.php";
require_once "modules/produtos.php";

$id = addslashes($_GET["id"] ?? "");
$option = addslashes($_GET["option"] ?? "");

$historico = new HistoricoDB();
$produto = new ProdutoDB();

if (isset($id) && isset($option)) :
    $historico->setFiltro("WHERE h.id = $id");
    $row = $historico->select()[0]; ?>

    <div id="formulario">
        <form action="modules/function/funcao.php" method="POST" id="formulario">
            <h2>REGISTRO</h2>
            <div>
                <label class="labels">Nome</label>
                <input type="text" name="nome" id="nome" class="fields" value="<?= $row->nome;?>" placeholder="Nome">
                <input type="hidden" name="idcliente" value="<?= $row->idcliente; ?>">
                <input type="hidden" name="historicoid" value = "<?= $_GET["id"]?>">
            </div>
            <div>
                    <label class="labels">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" value = "<?= $row->telefone;?>" class="fields">
                </div>
            <div>
                <label class="labels">Produto</label>
                <select name="produtos" id="select" class="fields">
                    <option value="<?=$row->idproduto; ?>"><?= $row->produto; ?></option>
                    <?php
                    foreach ($produto->select() as $rowp) {
                        echo "<option value='$rowp->id'>$rowp->produto</option>";
                    }?>
                </select>
            </div>
            <div>
                <label class="labels">STATUS</label>
                <select name="status" id="select" class="fields">
                    <option value="<?= $row->status_p?>" selected><?= $row->status_p?></option>
                    <?php if($row->status_p == "ENTREGUE"){
                        echo '<option value="EM PRODUCAO">EM PRODUCAO</option>';
                    }else{
                        echo '<option value="ENTREGUE">ENTREGUE</option>';
                    }?>
                </select>
            </div>
            <div id="qtd-data">
                <div id="qtd">
                    <label class="labels">Quantidade</label>
                    <input type="number" name="quantidade" id="qtd" min="1" value="<?= $row->qtd; ?>" placeholder="QTD">
                </div>
                <div id="data">
                    <label class="labels">Data</label>
                    <input type="date" name="data" id="data" value="<?= $row->entrega; ?>">
                </div>
            </div>
            <div id="user_button">
                <input type="submit" value="Editar" id="editar_btn" name="botao">
                <input type="submit" value="Delete" id="delete_btn" name="botao">
            </div>
        </form>
    </div>
    <script src="js/pop-up.js"></script>
    </main>
    </div>
    </body>

    </html>
<?php endif; ?>