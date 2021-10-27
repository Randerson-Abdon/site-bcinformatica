<!-- Modal -->
<div class="modal fade" id="confirmaLocalidade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Faturamento e Impressão</h5>
            </div>
            <form action="model/processa_fat_impressao.php" method="post" target="_blank">
                <div class="modal-body">


                    <div class="form-group col-md-12">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="fornecedor">Escolha o Município</label>
                            <select class="form-select mr-2" id="bd" name="bd" style="text-transform:uppercase;">

                                <option value="001">Santa Izabel</option>
                                <option value="002">Cametá</option>

                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button name="salvar" type="submit" class="btn btn-blue">Gerar</button>
                    <button type="button" onclick="location.href='admin.php'" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var myModal = document.getElementById('confirmaLocalidade')
    var myInput = document.getElementById('myInput')

    $(document).ready(function() {
        $('#confirmaLocalidade').modal('show');
    })

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
</script>