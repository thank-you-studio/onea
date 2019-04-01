var ArticleModule = {
    content: $('[data-module="article"]'),
    removePtagsFromImgs: function(pTags){
        pTags.each(function(index,el){
            console.log($(el).contents()[0].localName)
            if($(el).contents()[0].localName == 'img'){
                console.log($(el).contents().unwrap())
            }
            // if($(this).has('img')){
            //     $(this).unwrap();
            // }
        })
    },
    init: function(){
        if(this.content.length > 0){
            $pTags = this.content.find('p');
            if($pTags.length > 0){
                this.removePtagsFromImgs($pTags)
            }
        }
    }
};