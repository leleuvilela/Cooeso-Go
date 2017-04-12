angular.module('app.controllers')
    .controller('BoletoController', ['$scope', '$cookies', '$http', function ($scope, $cookies, $http) {
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
            numCGCCPFSacador: "19213714000106",
            dataVencimentoTit: vencimento,
            descInstrucao1: "bla lba bla",
            descInstrucao2: "blabl",
            descInstrucao3: "asdf",
            descInstrucao4: "asasdfdf",
            descInstrucao5: "asdfasdf"
        }

        $scope.enviar = function(){
            console.log($scope.boleto);
            $http({
                method  : 'POST',
                url     : 'https://geraboleto.sicoobnet.com.br/geradorBoleto/GerarBoleto.do',
                data    : $scope.boleto, //forms user object
                headers : {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .success(function(data) {
                    console.log(data);
                });
        }

    }]);