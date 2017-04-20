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

        $scope.cliente = new Client();
        $scope.categoria = [
            {id: 0, label: 'MÉDICOS ACIMA DE 70 ANOS', valor:'0'},
            {id: 1, label: 'MÉDICOS', valor:'200'},
            {id: 2, label: 'RESIDENTES E FELLOWS', valor:'150'},
            {id: 3, label: 'ACADÊMICOS', valor:'80'}
        ];

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
            valor: "",
            dataVencimentoTit: vencimento,
            descInstrucao1: "3 CONGRESSO DE OFTAMOLOGIA DA UFG",
            descInstrucao2: "9 E 10 DE JUNHO 2017",
            descInstrucao3: "AUDITORIO CREMEGO, GOIANIA",
            descInstrucao4: "CPF: "+$scope.cliente.cpf,
            descInstrucao5: ""
        };

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
            $scope.boleto.valor = $scope.categoria[$scope.categoriaId].valor;
            $scope.boleto.descInstrucao5 = $scope.categoria[$scope.categoriaId].label;
            if ($scope.formBoleto.$valid){
                document.getElementById("formBoleto").submit();
                $scope.cliente.$save();
            }
        }

    }]);
