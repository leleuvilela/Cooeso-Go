angular.module('app.controllers')
    .controller('BoletoController', ['$scope', '$cookies', '$http', 'Client', function ($scope, $cookies, $http, Client) {
        console.log($cookies.getObject('user'));

        getStringDate = function(date){
            var dd = date.getDate();
            var mm = date.getMonth()+1;
            var yyyy = date.getFullYear();
            if(dd<10){
                dd='0'+dd;
            }
            if(mm<10){
                mm='0'+mm;
            }
            return yyyy+""+mm+""+dd;
        };

        var now = new Date();

        var hoje = getStringDate(now);

        var vencimento = new Date();
        vencimento.setDate(vencimento.getDate() + 5);

        vencimento = getStringDate(vencimento);

        $scope.boleto = {
            numCliente: "145025",
            coopCartao: "5004",
            chaveAcessoWeb: "DEFBF33A-E701-4C71-AB46-4D4A1D3459B2",
            numContaCorrente: "1057596",
            codMunicipio: "26242",
            dataEmissao: hoje,
            nomeSacador: "COOPERATIVA ESTADUAL DE SERVICOS EM OFTALMOLOGIA",
            bolRecebeBoletoEletronico: "1",
            codEspDocumento: "5",
            codTipoVencimento: "1",
            bolAceite: "1",
            numCGCCPFSacador: "19213714000106",
            dataVencimentoTit: vencimento,
            descInstrucao1: "bla lba bla",
            descInstrucao2: "blabl",
            descInstrucao3: "asdf",
            descInstrucao4: "asasdfdf",
            descInstrucao5: "asdfasdf"
        };
        $scope.cliente = new Client();

        $scope.data_nascimento = {
            status:{
                opened: false
            }
        };

        $scope.open = function ($event){
            $scope.data_nascimento.status.opened = true;
        };


        $scope.enviar = function(){
            $scope.cliente.data_nascimento_validada = getStringDate($scope.cliente.data_nascimento);
            console.log($scope.cliente);
            if ($scope.formBoleto.$valid){
                $scope.cliente.$save().then(function () {
                    document.getElementById("formBoleto").submit();
                });
            }
        }

    }]);