import Emitter from 'tiny-emitter';
import IntersectionObserverPolyFill from 'intersection-observer'
import App from '../App'


const DEFAULT_OPTIONS = {
  // The root to use for intersection.
  // If not provided, use the top-level document’s viewport.
  root: null,
  // Same as margin, can be 1, 2, 3 or 4 components, possibly negative lengths.
  // If an explicit root element is specified, components may be percentages of the
  // root element size.  If no explicit root element is specified, using a percentage
  // is an error.
  rootMargin: '150px 0px 80px 0px',
  // Threshold(s) at which to trigger callback, specified as a ratio, or list of
  // ratios, of (visible area / total area) of the observed element (hence all
  // entries must be in the range [0, 1]).  Callback will be invoked when the visible
  // ratio of the observed element crosses a threshold in the list.
  threshold: 0,
  container:  document
};

export default class DisplayOnViewport extends Emitter {
  constructor(options = {}) {
    super();

    this.options = Object.assign({}, DEFAULT_OPTIONS, options);

    // Function binding
    this._callback = this._callback.bind(this);

    // Instanciate an IntersectionObserver
    this.observer = new IntersectionObserver(this._callback, this.options);

    this.count = 0
    // this.run();
  }

  // Observe elements mathcing the `.js-lazy-load` selector
  run() {
    
    const els = this.options.container.querySelectorAll('.js-on-viewport:not(.is-displayed)');
    
    this.toDisplay = []
    App.on('loop', ()=>this.loop())

    for( let i = 0, lg = els.length; i<lg; i++ ){
      this.observer.observe(els[i])
    }
    // els.forEach(el => this.observer.observe(el));

  }

  // Disconnect entire IntersectionObserver
  destroy() {
    this.observer.disconnect();
  }

  // Reset running IntersectionObserver
  reset() {
    this.destroy();
    this.run();
  }

  loop(){
    if( this.toDisplay.length > 0 && this.count == 0 ){
      this.toDisplay[0].classList.add('is-displayed');
      this.toDisplay.shift()

      this.count = 6
    }else if( this.count > 0 ){
      this.count--
    }
  }

  addItemToDisplay(el){
    this.toDisplay.push(el)
  }
  removeItemToDisplay(el){
    var index = this.toDisplay.indexOf(el);
    if (index > -1) {
      this.toDisplay.splice(index, 1);
    }
    el.classList.remove('is-displayed');
  }

  _callback(entries) {
    entries.forEach((entry, index) => {
      const el = entry.target;
      if (entry.intersectionRatio > 0 || entry.isIntersecting) {
        if( ! el.classList.contains('js-on-viewport--loop') ){
          this.observer.unobserve(el);
        }

        if( el.classList.contains('grid-item') ){
          this.addItemToDisplay(el)
        }else{
          el.classList.add('is-displayed')
        }
      }else{
        if( el.classList.contains('js-on-viewport--loop') ){
          if( el.classList.contains('grid-item') ){
            this.removeItemToDisplay(el)
          }else{
            el.classList.remove('is-displayed')
          }
        }     
      }
    });
  }

}