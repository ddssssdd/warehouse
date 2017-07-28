<script type="text/javascript">
	$("table").each(function(item){
        var table = $(this);
        var headers = table.find("thead th");

        headers.each(function(index,header){
            var text =$(header).text().trim();
            if (text){
                var html = "<span>"+text+"</span><span class='pull-right'><i class='fa fa-fw fa-sort'></i></span>";
                $(header).html(html);

                $(header).bind('click',function(event){
                    //console.log(index);
                    var dir =1;
                    var sort = 0;
                    if ($(header).find("i").hasClass("fa-sort-desc")){


                        $(header).find("i").removeClass('fa-sort-desc');
                        $(header).find("i").addClass('fa-sort-asc');
                    }else{
                        dir = -1;
                        $(header).find("i").removeClass('fa-sort-asc');
                        $(header).find("i").addClass('fa-sort-desc');
                    }
                    var rows = table.find("tbody tr").get();
                    //var isNumber =$(header).hasAttribute("sort-number");
                    var isNumber = this.getAttribute("sort-number");
                    rows.sort(function(a,b){
                        var keyA = $(a).children('td').eq(index).text().trim().toUpperCase();
                        var keyB = $(b).children('td').eq(index).text().trim().toUpperCase();
                        if (isNumber){
                            keyA = (keyA?keyA:0)*1;
                            keyB = (keyB?keyB:0)*1;
                        }
                        if (keyA<keyB) sort = -1;
                        if (keyA>keyB) sort = 1;
                        return sort*dir;
                    });
                    $.each(rows,function(index,row){
                        table.children('tbody').append(row);
                    });
                })
            }


        })

    });
</script>	
</body>
</html>
