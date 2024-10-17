<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<style>

.img-error{
width:350px;
height:350px;
}
</style>

<div class="container-fluid bootstrap snippets bootdey">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right" style="margin-top:10px;">
                <div class="col-md-10 col-md-offset-1 pull-right">
                    <img class="img-error" src="https://bootdey.com/img/Content/fdfadfadsfadoh.png">
                    <h2>Não conseguimos encontrar nenhuma barbearia na sua região</h2>
                    <p>Indique o sistema para seu barbeiro e agilize seu corte de cabelo</p>
                    <div class="error-actions">
                        <a href="javascript:history.go(-1);" class="btn btn-primary btn-lg">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>