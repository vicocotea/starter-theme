import abspos from './util/absolute-position'
import DisplayOnViewport from './util/display-on-viewport'

import EventEmitter from 'tiny-emitter'

let tickingScroll = false

class Main extends EventEmitter {
	constructor(){
    super()
	}
  
  start(){

    window.addEventListener('resize', (e)=>this._resize() )
    this._resize()

    this.scrollTop = getScrollTop()
    this.smoothScrollTop = this.scrollTop
    document.addEventListener('scroll', ()=>this._scroll(), { passive: true } )

    // this.header = new Header()

    this._build()
    this._resize()
    this._scroll()
    this._loop()
  }

  _build(){
    
  }

  _loop(){
    requestAnimationFrame(()=>this._loop())
    // console.log('loop')
    if( tickingScroll ){
      this.emit('scroll', this.scrollTop)
      tickingScroll = false
    }

    // let smoothedScroll = smoothValue( this.scrollTop, this.smoothScrollTop, 0.1, 3 )
    // if( this.smoothScrollTop != this.scrollTop ){
    //   this.smoothScrollTop = smoothedScroll
    //   this.emit('smoothScroll', this.smoothScrollTop)
    // }

    this.emit('loop')
  }

  _scroll(){
    if (!tickingScroll) {
      this.scrollTop = getScrollTop()
    }
    tickingScroll = true;
  }

  _resize(){

    this.innerHeight = window.innerHeight
    this.innerWidth = window.innerWidth

    let vh = this.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);

    let isMobile = false
    if( this.innerWidth < 768 ) isMobile = true

    if( this.isMobile == null ){
      this.isMobile = isMobile
    }else if( isMobile != this.isMobile ){
      window.location.reload()
    }

    this.emit('resize')
  }
}

function getScrollTop(){
  return window.scrollY || window.pageYOffset || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0)
}

let app = new Main
export default app