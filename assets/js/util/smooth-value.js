/*
 * smooth value to avoid infinite smooth
 */
export default function( to, current, factor = 0.01, precision = 2 ){

  const precisionPow = Math.pow( 10, precision )
  const invertPrecisionPow = 1 / precisionPow

  if( current.toFixed(precision) !== to.toFixed(precision) ){
    let delta = (to - current) * factor
    delta = delta * precisionPow / precisionPow
    
    if( Math.abs( delta ) > invertPrecisionPow ){
      current += delta  
    }else{
      if( delta != 0 ){
        if( delta > 0 ){
          current += invertPrecisionPow
        }else{
          current -= invertPrecisionPow
        }
      }
    }
    return parseFloat( current.toFixed( precision ) )
  }else{
    return current
  }

}