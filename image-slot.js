// Placeholder image slot for design mode
function ImageSlot(props) {
  var p = props || {};
  var w = p.width || 400;
  var h = p.height || 300;
  var label = p.label || (w + '×' + h);
  return React.createElement('div', {
    style: Object.assign({
      width: w, height: h,
      background: 'rgba(255,255,255,0.04)',
      borderRadius: 12,
      display: 'flex', alignItems: 'center', justifyContent: 'center',
      color: 'rgba(255,255,255,0.15)',
      fontSize: 13,
      fontFamily: "'JetBrains Mono', monospace",
      border: '1px dashed rgba(255,255,255,0.08)',
      userSelect: 'none',
    }, p.style || {})
  }, label);
}
