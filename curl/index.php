<form action="post.php" method="post" enctype="multipart/form-data">
    <label>File:</label>
    <input type="file" name="file[]" multiple><br>
    <label>Field Array:</label>
    <select name="field_array[]" multiple>
        <option value="1">Opcao 1</option>
        <option value="2">Opcao 2</option>
        <option value="3">Opcao 3</option>
    </select>
    <br>
    <label>Field text:</label>
      <input type="text" name="field_text"><br>
    <br>
    <button type="submit">Enviar</button>
</form>
