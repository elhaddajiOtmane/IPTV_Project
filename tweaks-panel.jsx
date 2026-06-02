/* ── tweaks-panel.jsx ─────────────────────────────────────────────────────────
   Global accent palette, useTweaks hook, and the live design-tweaks panel.
   Loaded before desktop-landing.jsx so ACCENTS / useTweaks are available
   to the inline App script in desktop.html.
─────────────────────────────────────────────────────────────────────────── */

const ACCENTS = {
  violet: {
    base:   '#7c3aed',
    light:  '#a78bfa',
    mid:    '#8b5cf6',
    glow:   'rgba(124,58,237,0.40)',
    subtle: 'rgba(124,58,237,0.13)',
    grad:   'linear-gradient(135deg,#7c3aed,#a78bfa)',
  },
  cyan: {
    base:   '#06b6d4',
    light:  '#67e8f9',
    mid:    '#22d3ee',
    glow:   'rgba(6,182,212,0.40)',
    subtle: 'rgba(6,182,212,0.13)',
    grad:   'linear-gradient(135deg,#06b6d4,#67e8f9)',
  },
  amber: {
    base:   '#f59e0b',
    light:  '#fcd34d',
    mid:    '#fbbf24',
    glow:   'rgba(245,158,11,0.40)',
    subtle: 'rgba(245,158,11,0.13)',
    grad:   'linear-gradient(135deg,#f59e0b,#fcd34d)',
  },
};

function useTweaks(defaults) {
  const [state, setState] = React.useState(defaults);
  const set = React.useCallback((key, val) => setState(s => ({ ...s, [key]: val })), []);
  return [state, set];
}

function TweaksPanel({ children }) {
  const [open, setOpen] = React.useState(true);
  return (
    <>
      <button
        onClick={() => setOpen(o => !o)}
        style={{
          position: 'fixed', bottom: 24, right: open ? 308 : 24, zIndex: 9001,
          width: 38, height: 38, borderRadius: '50%',
          background: '#1e1a2e', border: '1px solid rgba(255,255,255,0.15)',
          color: 'rgba(255,255,255,0.65)', fontSize: 17, cursor: 'pointer',
          display: 'flex', alignItems: 'center', justifyContent: 'center',
          boxShadow: '0 4px 20px rgba(0,0,0,0.5)',
          transition: 'right 0.3s cubic-bezier(0.4,0,0.2,1)',
        }}
        title={open ? 'Close tweaks' : 'Open tweaks'}
      >⚙</button>

      <div style={{
        position: 'fixed', bottom: 24, right: 24, zIndex: 9000,
        width: 272, background: '#1a1630',
        border: '1px solid rgba(255,255,255,0.12)', borderRadius: 16,
        padding: '20px 18px',
        boxShadow: '0 12px 48px rgba(0,0,0,0.65)',
        transform: open ? 'translateX(0)' : 'translateX(calc(100% + 32px))',
        transition: 'transform 0.3s cubic-bezier(0.4,0,0.2,1)',
        fontFamily: "'Inter', system-ui, sans-serif",
      }}>
        <div style={{
          fontSize: 11, fontWeight: 700, letterSpacing: '0.1em',
          textTransform: 'uppercase', color: 'rgba(255,255,255,0.35)',
          marginBottom: 14,
        }}>Design Tweaks</div>
        {children}
      </div>
    </>
  );
}

function TweakSection({ label }) {
  return (
    <div style={{
      fontSize: 10, fontWeight: 700, letterSpacing: '0.1em',
      textTransform: 'uppercase', color: 'rgba(255,255,255,0.28)',
      borderTop: '1px solid rgba(255,255,255,0.07)',
      paddingTop: 12, marginTop: 14, marginBottom: 8,
    }}>{label}</div>
  );
}

function TweakColor({ label, value, options, onChange }) {
  return (
    <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: 10 }}>
      <span style={{ fontSize: 13, color: 'rgba(255,255,255,0.65)' }}>{label}</span>
      <div style={{ display: 'flex', gap: 7 }}>
        {options.map(col => (
          <button key={col} onClick={() => onChange(col)} style={{
            width: 22, height: 22, borderRadius: '50%', background: col,
            border: col === value ? '2px solid #fff' : '2px solid transparent',
            cursor: 'pointer', outline: 'none',
            boxShadow: col === value ? '0 0 0 2px rgba(255,255,255,0.25)' : 'none',
            transition: 'all 0.15s',
          }} />
        ))}
      </div>
    </div>
  );
}

function TweakRadio({ label, value, options, onChange }) {
  return (
    <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: 10 }}>
      <span style={{ fontSize: 13, color: 'rgba(255,255,255,0.65)' }}>{label}</span>
      <div style={{ display: 'flex', gap: 3, background: 'rgba(255,255,255,0.06)', borderRadius: 8, padding: 3 }}>
        {options.map(opt => (
          <button key={opt} onClick={() => onChange(opt)} style={{
            padding: '4px 11px', borderRadius: 6, border: 'none',
            background: value === opt ? 'rgba(255,255,255,0.16)' : 'transparent',
            color: value === opt ? '#fff' : 'rgba(255,255,255,0.4)',
            fontSize: 12, fontWeight: 500, cursor: 'pointer',
            transition: 'all 0.15s', textTransform: 'capitalize',
          }}>{opt}</button>
        ))}
      </div>
    </div>
  );
}
