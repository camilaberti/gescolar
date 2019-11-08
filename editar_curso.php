<?php
try
{
    include 'includes/conexao.php';

    if(isset($_REUQEST['atualizar']))
    {
        $sql = "UPDATE curso SET nome = ? WHERE id = ?";

        $stmt = $conexao -> prepare($sql);
        $stmt->bindParam(1, $_REQUEST['nome']);
        $stmt->bindParam(1, $_REQUEST['id_curso']);
        $stmt->execute();
    }

    if(isset($_REUQEST['excluir']))
    {
    $stmt = $conexao -> prepare("DELETE FROM curso WHERE id = ?");   
    $stmt->bindParam(1, $_REQUEST['id_curso']);
    $stmt->execute();
    header("location: lista_cursos.php");

    }

    $stmt = $conexao -> prepare($sql);
    $stmt->bindParam(1, $_REQUEST['id_curso']);
    $stmt->execute();

    $curso = $stmt->fechObject();
}catch (Exception $e) {
    echo $e->getMessege();
}
?>
<link href="css/estilos.css" type="text/css" rel="stylesheet" />
<?php include_once 'includes/cabecalho.php' ?>
<div>
<fieldset>
  <legend>Cadastro de curso </legend>
     <form action = "editor_curso.php?atualizar=true">
    <label>Nome:
        <input type="text" name = "nome" required value="<?= $curso->nome ?>" />
    </label>

    <a href="editar_curso.php?excluir=true&id=<?= $curso->id ?>">Excluir</a>

    <button type="submit">salvar</button>

   </form>
 </legend>
</div>