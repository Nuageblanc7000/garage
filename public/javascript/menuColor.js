
        const naviColor = document.querySelector('.naviColor');
        const vidBot = document.querySelector('.vidBot')

        const changeColor =()=>{

            let infoVid = vidBot.getBoundingClientRect().bottom
            
            const  {scrollTop} = document.documentElement 
            
            let infoNav = naviColor.getBoundingClientRect().top;
            
            if(scrollTop  >= (scrollTop + infoVid - 50).toFixed()){
               
                naviColor.classList.add('headerDark')
    
            }else{
                naviColor.classList.remove('headerDark ')
            }
        }
        
        window.addEventListener('scroll',changeColor)
    