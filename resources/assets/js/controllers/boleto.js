angular.module('app.controllers')
    .controller('BoletoController', ['$scope', '$cookies', function ($scope, $cookies) {
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







    }]);