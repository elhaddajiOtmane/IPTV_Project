/* ── desktop-landing.jsx ──────────────────────────────────────────────────────
   Empier IPTV — Desktop landing page.
   Rendered only on desktop (min-width enforced by the WordPress theme via
   a separate page template; this file is loaded exclusively from desktop.html).

   Depends on ACCENTS defined in tweaks-panel.jsx (loads first).
─────────────────────────────────────────────────────────────────────────── */

/* ─── shared helpers ─────────────────────────────────────────────────────── */

function useHover() {
  const [hov, set] = React.useState(false);
  return [hov, { onMouseEnter: () => set(true), onMouseLeave: () => set(false) }];
}

function Grad({ ac, children, style = {} }) {
  return (
    <span style={{
      background: ac.grad,
      WebkitBackgroundClip: 'text',
      WebkitTextFillColor: 'transparent',
      backgroundClip: 'text',
      ...style,
    }}>{children}</span>
  );
}

function SectionLabel({ label, ac }) {
  return (
    <div style={{
      display: 'inline-block',
      padding: '4px 14px', borderRadius: 99,
      background: ac.subtle, border: `1px solid ${ac.glow}`,
      fontSize: 11, fontWeight: 700, letterSpacing: '0.1em',
      textTransform: 'uppercase', color: ac.light,
      marginBottom: 20,
    }}>{label}</div>
  );
}

function SectionHead({ label, title, sub, ac, c }) {
  return (
    <div style={{ textAlign: 'center', maxWidth: 640, margin: '0 auto' }}>
      <SectionLabel label={label} ac={ac} />
      <h2 style={{
        fontSize: 48, fontWeight: 900, letterSpacing: '-1.5px',
        lineHeight: 1.08, margin: '0 0 18px',
        fontFamily: "'Inter', sans-serif",
      }}>{title}</h2>
      <p style={{ fontSize: 17, color: c.sub, lineHeight: 1.7, margin: 0 }}>{sub}</p>
    </div>
  );
}

function Btn({ label, primary, ac, c, style: extra = {} }) {
  const [hov, bind] = useHover();
  return (
    <button {...bind} style={{
      padding: '14px 26px', borderRadius: 12,
      fontSize: 15, fontWeight: 600, cursor: 'pointer',
      border: 'none', transition: 'all 0.2s',
      ...(primary ? {
        background: ac.grad, color: '#fff',
        boxShadow: hov ? `0 8px 36px ${ac.glow}` : `0 3px 18px ${ac.glow}`,
        transform: hov ? 'translateY(-2px)' : 'none',
      } : {
        background: hov ? c.card2 : c.card,
        border: `1px solid ${c.border}`,
        color: c.text,
        transform: hov ? 'translateY(-1px)' : 'none',
      }),
      ...extra,
    }}>{label}</button>
  );
}

/* ─── Navbar ─────────────────────────────────────────────────────────────── */

function NavLink({ label, c }) {
  const [hov, bind] = useHover();
  return (
    <a {...bind} style={{
      color: hov ? c.text : c.sub, fontSize: 14, fontWeight: 500,
      textDecoration: 'none', transition: 'color 0.18s', cursor: 'pointer',
    }}>{label}</a>
  );
}

function DesktopNavbar({ ac, c }) {
  const [scrolled, setScrolled] = React.useState(false);
  React.useEffect(() => {
    const fn = () => setScrolled(window.scrollY > 12);
    window.addEventListener('scroll', fn, { passive: true });
    return () => window.removeEventListener('scroll', fn);
  }, []);

  return (
    <nav style={{
      position: 'fixed', top: 0, left: 0, right: 0, zIndex: 200,
      height: 68, padding: '0 64px',
      display: 'flex', alignItems: 'center',
      backdropFilter: scrolled ? 'blur(28px) saturate(180%)' : 'none',
      background: scrolled ? c.navBg : 'transparent',
      borderBottom: `1px solid ${scrolled ? c.border : 'transparent'}`,
      transition: 'background 0.35s, border-color 0.35s',
    }}>
      {/* Logo */}
      <div style={{ display: 'flex', alignItems: 'center', gap: 10, marginRight: 'auto' }}>
        <div style={{
          width: 34, height: 34, borderRadius: 9,
          background: ac.grad, display: 'flex',
          alignItems: 'center', justifyContent: 'center',
          fontWeight: 900, fontSize: 18, color: '#fff',
          boxShadow: `0 0 18px ${ac.glow}`,
        }}>E</div>
        <span style={{ fontWeight: 800, fontSize: 20, letterSpacing: '-0.6px' }}>Empier</span>
        <span style={{
          padding: '2px 8px', borderRadius: 4,
          background: ac.subtle, color: ac.light,
          fontSize: 10, fontWeight: 700, letterSpacing: '0.06em', marginLeft: 2,
        }}>IPTV</span>
      </div>

      {/* Links */}
      <div style={{ display: 'flex', gap: 36, marginRight: 48 }}>
        {['Features', 'Channels', 'Pricing', 'Support'].map(l => (
          <NavLink key={l} label={l} c={c} />
        ))}
      </div>

      {/* Actions */}
      <div style={{ display: 'flex', gap: 12 }}>
        <button style={{
          padding: '9px 22px', borderRadius: 9,
          background: 'transparent', border: `1px solid ${c.border}`,
          color: c.text, fontSize: 14, fontWeight: 500, cursor: 'pointer',
        }}>Sign in</button>
        <button style={{
          padding: '9px 22px', borderRadius: 9,
          background: ac.grad, border: 'none',
          color: '#fff', fontSize: 14, fontWeight: 600, cursor: 'pointer',
          boxShadow: `0 0 22px ${ac.glow}`,
        }}>Start Free Trial</button>
      </div>
    </nav>
  );
}

/* ─── TV Mockup (used in Hero) ───────────────────────────────────────────── */

function PlayBtn({ ac }) {
  const [hov, bind] = useHover();
  return (
    <div {...bind} style={{
      width: 52, height: 52, borderRadius: '50%',
      background: ac.grad, display: 'flex',
      alignItems: 'center', justifyContent: 'center',
      margin: '0 auto', cursor: 'pointer', fontSize: 20,
      boxShadow: hov ? `0 0 36px ${ac.glow}` : `0 0 18px ${ac.glow}`,
      transform: hov ? 'scale(1.1)' : 'scale(1)',
      transition: 'all 0.2s',
    }}>▶</div>
  );
}

function ChannelCard({ ch, c, ac }) {
  const [hov, bind] = useHover();
  return (
    <div {...bind} style={{
      padding: '10px 11px', borderRadius: 10, cursor: 'pointer',
      background: hov ? c.card2 : c.card,
      border: `1px solid ${hov ? ac.subtle : c.border}`,
      transition: 'all 0.18s',
    }}>
      <div style={{
        width: 28, height: 28, borderRadius: 7, marginBottom: 7,
        background: ch.col + '22', border: `1px solid ${ch.col}44`,
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        fontSize: 10, fontWeight: 800, color: ch.col,
      }}>{ch.name.slice(0, 2)}</div>
      <div style={{ fontSize: 11, fontWeight: 700, marginBottom: 3 }}>{ch.name}</div>
      <div style={{ display: 'flex', alignItems: 'center', gap: 4 }}>
        {ch.live && <span style={{ width: 5, height: 5, borderRadius: '50%', background: '#22c55e', display: 'inline-block' }} />}
        <span style={{ fontSize: 10, color: c.sub }}>{ch.live ? 'Live' : ch.cat}</span>
      </div>
    </div>
  );
}

function TvMockup({ ac, dark, c }) {
  const channels = [
    { name: 'ESPN HD',   cat: 'Sports',  col: '#dc2626', live: true  },
    { name: 'Netflix',   cat: 'Movies',  col: '#e50914', live: false },
    { name: 'CNN',       cat: 'News',    col: '#cc0000', live: true  },
    { name: 'Discovery', cat: 'Docs',    col: '#1a73e8', live: true  },
    { name: 'HBO Max',   cat: 'Series',  col: '#a855f7', live: false },
    { name: 'BBC World', cat: 'News',    col: '#c9a227', live: true  },
  ];

  return (
    <div style={{
      width: 540, borderRadius: 20,
      background: dark ? '#0e0b1c' : '#ffffff',
      border: `1px solid ${c.border}`,
      boxShadow: `0 0 130px ${ac.glow}, 0 40px 80px rgba(0,0,0,0.45)`,
      overflow: 'hidden',
    }}>
      {/* Browser chrome */}
      <div style={{
        padding: '11px 16px',
        background: dark ? 'rgba(255,255,255,0.04)' : 'rgba(0,0,0,0.04)',
        borderBottom: `1px solid ${c.border}`,
        display: 'flex', alignItems: 'center', gap: 8,
      }}>
        <div style={{ display: 'flex', gap: 6 }}>
          {['#ff5f56','#febc2e','#27c93f'].map(col => (
            <div key={col} style={{ width: 10, height: 10, borderRadius: '50%', background: col }} />
          ))}
        </div>
        <div style={{
          flex: 1, height: 26,
          background: dark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.05)',
          borderRadius: 5, display: 'flex', alignItems: 'center', paddingLeft: 10,
          fontFamily: "'JetBrains Mono', monospace",
          fontSize: 11, color: c.sub,
        }}>empier.tv/live</div>
      </div>

      {/* Now Playing */}
      <div style={{
        height: 192,
        background: dark
          ? 'linear-gradient(135deg,#1a0f2e 0%,#0e0b1c 100%)'
          : 'linear-gradient(135deg,#e8e0ff 0%,#f0eeff 100%)',
        position: 'relative', display: 'flex',
        alignItems: 'center', justifyContent: 'center', overflow: 'hidden',
      }}>
        <div style={{
          position: 'absolute', inset: 0,
          background: `radial-gradient(circle at 30% 50%, ${ac.glow}, transparent 60%)`,
          opacity: 0.65,
        }} />
        <div style={{ position: 'relative', textAlign: 'center' }}>
          <PlayBtn ac={ac} />
          <div style={{ fontSize: 14, fontWeight: 700, marginTop: 10 }}>FIFA World Cup · Highlights</div>
          <div style={{ fontSize: 12, color: c.sub, marginTop: 3 }}>ESPN HD · Now Playing</div>
        </div>
        <div style={{
          position: 'absolute', top: 12, right: 12,
          padding: '3px 9px', borderRadius: 5,
          background: '#ef4444', fontSize: 10, fontWeight: 700, color: '#fff',
          letterSpacing: '0.04em',
        }}>● LIVE</div>
        <div style={{ position: 'absolute', bottom: 0, left: 0, right: 0, height: 3, background: 'rgba(255,255,255,0.1)' }}>
          <div style={{ height: '100%', width: '42%', background: ac.grad }} />
        </div>
      </div>

      {/* Channel grid */}
      <div style={{ padding: 16 }}>
        <div style={{
          fontSize: 11, fontWeight: 700, color: c.dim,
          textTransform: 'uppercase', letterSpacing: '0.1em', marginBottom: 12,
        }}>Popular Channels</div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 8 }}>
          {channels.map((ch, i) => <ChannelCard key={i} ch={ch} c={c} ac={ac} />)}
        </div>
      </div>

      {/* Footer */}
      <div style={{
        padding: '10px 16px', borderTop: `1px solid ${c.border}`,
        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        background: dark ? 'rgba(255,255,255,0.02)' : 'rgba(0,0,0,0.02)',
      }}>
        <span style={{ fontSize: 11, color: c.dim, fontFamily: "'JetBrains Mono', monospace" }}>
          6 of 10,000+ channels
        </span>
        <span style={{
          fontSize: 11, fontWeight: 600, color: ac.light,
          padding: '3px 10px', borderRadius: 4, background: ac.subtle, cursor: 'pointer',
        }}>Browse All →</span>
      </div>
    </div>
  );
}

/* ─── Hero ───────────────────────────────────────────────────────────────── */

function AvatarRow({ ac, c }) {
  const colors = ['#8b5cf6','#06b6d4','#f59e0b','#ec4899','#22c55e'];
  return (
    <div style={{ display: 'flex', alignItems: 'center', gap: 14, marginTop: 32 }}>
      <div style={{ display: 'flex' }}>
        {colors.map((col, i) => (
          <div key={i} style={{
            width: 32, height: 32, borderRadius: '50%',
            background: `linear-gradient(135deg,${col},${col}99)`,
            border: '2px solid rgba(10,7,18,0.7)',
            marginLeft: i === 0 ? 0 : -10,
            display: 'flex', alignItems: 'center', justifyContent: 'center',
            fontSize: 12, fontWeight: 700, color: '#fff',
          }}>{String.fromCharCode(65 + i)}</div>
        ))}
      </div>
      <div>
        <div style={{ fontSize: 13, fontWeight: 600, display: 'flex', alignItems: 'center', gap: 4 }}>
          <span style={{ color: '#fbbf24' }}>★★★★★</span>
          <span style={{ marginLeft: 2 }}>4.9 / 5</span>
        </div>
        <div style={{ fontSize: 12, color: c.sub }}>Trusted by 50,000+ subscribers</div>
      </div>
    </div>
  );
}

function DesktopHero({ ac, dark, c, wrap }) {
  return (
    <section style={{
      minHeight: '100vh', paddingTop: 68,
      display: 'flex', alignItems: 'center',
      position: 'relative', overflow: 'hidden',
    }}>
      {/* Ambient glows */}
      <div style={{ position: 'absolute', top: '5%', left: '-8%', width: 720, height: 720, background: `radial-gradient(circle,${ac.glow},transparent 62%)`, opacity: 0.55, pointerEvents: 'none' }} />
      <div style={{ position: 'absolute', bottom: '-5%', right: '3%', width: 480, height: 480, background: `radial-gradient(circle,${ac.subtle},transparent 62%)`, opacity: 0.7, pointerEvents: 'none' }} />

      <div style={{ ...wrap, width: '100%', display: 'flex', alignItems: 'center', gap: 72, position: 'relative' }}>
        {/* Left */}
        <div style={{ flex: '0 0 48%' }}>
          {/* Live badge */}
          <div style={{
            display: 'inline-flex', alignItems: 'center', gap: 8,
            padding: '6px 14px', borderRadius: 99,
            background: ac.subtle, border: `1px solid ${ac.glow}`,
            color: ac.light, fontSize: 13, fontWeight: 600,
          }}>
            <span style={{ width: 7, height: 7, borderRadius: '50%', background: '#ef4444', display: 'inline-block', boxShadow: '0 0 8px #ef4444' }} />
            LIVE · 10,000+ channels streaming now
          </div>

          <h1 style={{
            fontSize: 68, fontWeight: 900, lineHeight: 1.04,
            letterSpacing: '-2.5px', margin: '24px 0 20px',
            fontFamily: "'Inter', sans-serif",
          }}>
            Watch the{' '}
            <Grad ac={ac}>world's TV</Grad>
            <br />on any screen.
          </h1>

          <p style={{ fontSize: 19, lineHeight: 1.7, color: c.sub, margin: '0 0 36px', maxWidth: 440 }}>
            Stream 10,000+ live channels, movies, and series in crystal-clear HD & 4K. No dish, no contract — just press play.
          </p>

          <div style={{ display: 'flex', gap: 14, marginBottom: 28 }}>
            <Btn label="Start Free Trial →" primary ac={ac} c={c} />
            <Btn label="▶  Watch Demo" ac={ac} c={c} />
          </div>

          <p style={{ fontSize: 13, color: c.dim }}>
            ✓ No credit card &nbsp;·&nbsp; ✓ Cancel anytime &nbsp;·&nbsp; ✓ 48h activation
          </p>

          <AvatarRow ac={ac} c={c} />
        </div>

        {/* Right */}
        <div style={{ flex: 1, display: 'flex', justifyContent: 'center' }}>
          <TvMockup ac={ac} dark={dark} c={c} />
        </div>
      </div>
    </section>
  );
}

/* ─── Stats strip ────────────────────────────────────────────────────────── */

function DesktopStats({ ac, c, wrap }) {
  const stats = [
    { n: '10,000+', label: 'Live Channels',  icon: '📡' },
    { n: '4K UHD',  label: 'Max Quality',    icon: '🎯' },
    { n: '99.9%',   label: 'Uptime SLA',     icon: '⚡' },
    { n: '24 / 7',  label: 'Live Support',   icon: '🛡' },
  ];
  return (
    <div style={{
      borderTop: `1px solid ${c.border}`,
      borderBottom: `1px solid ${c.border}`,
      background: c.statsBg,
    }}>
      <div style={{ ...wrap, display: 'flex' }}>
        {stats.map((s, i) => (
          <React.Fragment key={i}>
            <div style={{
              flex: 1, padding: '28px 0',
              display: 'flex', alignItems: 'center', gap: 16, justifyContent: 'center',
            }}>
              <span style={{ fontSize: 30 }}>{s.icon}</span>
              <div>
                <div style={{
                  fontSize: 28, fontWeight: 900, letterSpacing: '-1px',
                  fontFamily: "'JetBrains Mono', monospace",
                  background: ac.grad,
                  WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent',
                  backgroundClip: 'text',
                }}>{s.n}</div>
                <div style={{ fontSize: 13, color: c.sub, marginTop: 1 }}>{s.label}</div>
              </div>
            </div>
            {i < stats.length - 1 && (
              <div style={{ width: 1, background: c.border, margin: '20px 0' }} />
            )}
          </React.Fragment>
        ))}
      </div>
    </div>
  );
}

/* ─── Features ───────────────────────────────────────────────────────────── */

function FeatureCard({ f, ac, c }) {
  const [hov, bind] = useHover();
  return (
    <div {...bind} style={{
      padding: '28px', borderRadius: 16, cursor: 'default',
      background: hov ? c.card2 : c.card,
      border: `1px solid ${hov ? ac.subtle : c.border}`,
      transition: 'all 0.22s',
      transform: hov ? 'translateY(-4px)' : 'none',
      boxShadow: hov ? `0 12px 40px rgba(0,0,0,0.18)` : 'none',
    }}>
      <div style={{
        width: 46, height: 46, borderRadius: 13,
        background: ac.subtle, border: `1px solid ${ac.glow}`,
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        fontSize: 22, marginBottom: 18,
      }}>{f.icon}</div>
      <div style={{ fontSize: 17, fontWeight: 700, marginBottom: 9 }}>{f.title}</div>
      <div style={{ fontSize: 14, lineHeight: 1.7, color: c.sub }}>{f.desc}</div>
    </div>
  );
}

function DesktopFeatures({ ac, c, wrap }) {
  const features = [
    { icon: '📡', title: 'Live TV',           desc: '10,000+ channels from sports, news, entertainment, and more — all streaming live around the clock.' },
    { icon: '🎬', title: '4K Ultra HD',        desc: 'Experience cinema-quality streams at up to 4K UHD resolution with Dolby Audio and HDR support.' },
    { icon: '⏺',  title: 'DVR Recording',     desc: 'Record your favourite shows and watch them on your own schedule with up to 200h of cloud storage.' },
    { icon: '📱', title: 'Multi-Device',       desc: 'Smart TV, phone, tablet, laptop, Fire Stick — watch on any screen, up to 5 devices at once.' },
    { icon: '📋', title: '14-Day EPG Guide',   desc: 'Browse upcoming programs two weeks ahead and set smart reminders so you never miss a show.' },
    { icon: '👪', title: 'Parental Controls',  desc: 'PIN-protected profiles, content ratings, and kid-safe channel lists to keep every family safe.' },
  ];
  return (
    <section style={{ padding: '100px 0', position: 'relative', overflow: 'hidden' }}>
      <div style={{ position: 'absolute', top: '20%', right: '-4%', width: 520, height: 520, background: `radial-gradient(circle,${ac.subtle},transparent 65%)`, opacity: 0.5, pointerEvents: 'none' }} />
      <div style={{ ...wrap, position: 'relative' }}>
        <SectionHead
          label="Features"
          title={<>Everything you need to<br /><Grad ac={ac}>cut the cord.</Grad></>}
          sub="No satellite dish, no cable box. Just your internet connection and any screen you own."
          ac={ac} c={c}
        />
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 24, marginTop: 60 }}>
          {features.map((f, i) => <FeatureCard key={i} f={f} ac={ac} c={c} />)}
        </div>
      </div>
    </section>
  );
}

/* ─── Channel categories ─────────────────────────────────────────────────── */

function CatCard({ cat, c, ac }) {
  const [hov, bind] = useHover();
  return (
    <div {...bind} style={{
      padding: '22px 20px', borderRadius: 14, cursor: 'pointer',
      background: hov ? c.card2 : c.card,
      border: `1px solid ${hov ? cat.col + '55' : c.border}`,
      transition: 'all 0.18s',
      display: 'flex', alignItems: 'center', gap: 16,
    }}>
      <div style={{
        width: 48, height: 48, borderRadius: 13, flexShrink: 0,
        background: cat.col + '18', border: `1px solid ${cat.col}40`,
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        fontSize: 24,
      }}>{cat.icon}</div>
      <div>
        <div style={{ fontSize: 15, fontWeight: 700 }}>{cat.name}</div>
        <div style={{
          fontSize: 13, fontWeight: 700, color: cat.col, marginTop: 3,
          fontFamily: "'JetBrains Mono', monospace",
        }}>{cat.count}</div>
      </div>
    </div>
  );
}

function DesktopChannels({ ac, c, wrap }) {
  const cats = [
    { icon: '🏆', name: 'Sports',          count: '1,200+ channels', col: '#ef4444' },
    { icon: '🎬', name: 'Movies',           count: '3,500+ titles',   col: '#8b5cf6' },
    { icon: '📺', name: 'Entertainment',   count: '2,800+ channels', col: '#3b82f6' },
    { icon: '📰', name: 'News',             count: '800+ channels',   col: '#10b981' },
    { icon: '👶', name: 'Kids',             count: '450+ channels',   col: '#f59e0b' },
    { icon: '🌍', name: 'International',   count: '1,600+ channels', col: '#ec4899' },
    { icon: '🎵', name: 'Music',            count: '300+ channels',   col: '#14b8a6' },
    { icon: '🔬', name: 'Documentary',     count: '600+ channels',   col: '#6366f1' },
  ];
  return (
    <section style={{ padding: '100px 0', background: c.altBg }}>
      <div style={wrap}>
        <SectionHead
          label="Channels"
          title={<>Every genre.<br /><Grad ac={ac}>Every country.</Grad></>}
          sub="From premium sports to local news, kids programming to international cinema."
          ac={ac} c={c}
        />
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4,1fr)', gap: 16, marginTop: 60 }}>
          {cats.map((cat, i) => <CatCard key={i} cat={cat} c={c} ac={ac} />)}
        </div>
      </div>
    </section>
  );
}

/* ─── Pricing ────────────────────────────────────────────────────────────── */

function PricingCard({ plan, ac, c, dark }) {
  const [hov, bind] = useHover();
  return (
    <div {...bind} style={{
      padding: '32px 28px', borderRadius: 20, position: 'relative',
      background: plan.pop
        ? (dark ? '#1a1030' : '#ece6ff')
        : (hov ? c.card2 : c.card),
      border: plan.pop
        ? `2px solid ${ac.base}`
        : `1px solid ${hov ? ac.subtle : c.border}`,
      transition: 'all 0.22s',
      boxShadow: plan.pop
        ? `0 0 48px ${ac.glow}`
        : (hov ? `0 12px 40px rgba(0,0,0,0.15)` : 'none'),
    }}>
      {plan.pop && (
        <div style={{
          position: 'absolute', top: -13, left: '50%', transform: 'translateX(-50%)',
          padding: '4px 16px', borderRadius: 99,
          background: ac.grad, color: '#fff',
          fontSize: 11, fontWeight: 700, letterSpacing: '0.06em', whiteSpace: 'nowrap',
        }}>MOST POPULAR</div>
      )}
      <div style={{ fontSize: 17, fontWeight: 700, marginBottom: 4 }}>{plan.name}</div>
      <div style={{ fontSize: 13, color: c.sub, marginBottom: 22 }}>{plan.desc}</div>
      <div style={{ display: 'flex', alignItems: 'baseline', gap: 2, marginBottom: 26 }}>
        <span style={{
          fontSize: 54, fontWeight: 900, letterSpacing: '-2.5px',
          ...(plan.pop ? {
            background: ac.grad,
            WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text',
          } : {}),
        }}>{plan.price}</span>
        <span style={{ fontSize: 16, color: c.sub, fontWeight: 500 }}>/mo</span>
      </div>
      <button style={{
        width: '100%', padding: '13px', borderRadius: 11,
        background: plan.pop ? ac.grad : 'transparent',
        border: plan.pop ? 'none' : `1px solid ${c.border}`,
        color: plan.pop ? '#fff' : c.text,
        fontSize: 14, fontWeight: 600, cursor: 'pointer', marginBottom: 26,
        boxShadow: plan.pop ? `0 4px 22px ${ac.glow}` : 'none',
      }}>{plan.cta}</button>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 11 }}>
        {plan.features.map((f, i) => (
          <div key={i} style={{ display: 'flex', alignItems: 'flex-start', gap: 10, fontSize: 14 }}>
            <span style={{ color: ac.base, fontWeight: 700, flexShrink: 0, marginTop: 1 }}>✓</span>
            <span style={{ color: c.sub }}>{f}</span>
          </div>
        ))}
      </div>
    </div>
  );
}

function DesktopPricing({ ac, c, dark, wrap }) {
  const plans = [
    {
      name: 'Starter', price: '$9', desc: 'Perfect for individuals',
      features: ['1 simultaneous stream', '8,000+ channels', 'HD quality', '7-day EPG guide', 'Email support'],
      cta: 'Get Started', pop: false,
    },
    {
      name: 'Pro', price: '$19', desc: 'Most popular for families',
      features: ['3 simultaneous streams', '10,000+ channels', 'Full HD & 4K', '14-day EPG guide', 'DVR recording (100h)', 'Priority support'],
      cta: 'Start Free Trial', pop: true,
    },
    {
      name: 'Ultra', price: '$29', desc: 'For power users & large families',
      features: ['5 simultaneous streams', '10,000+ channels', '4K Ultra HD', '14-day EPG guide', 'DVR recording (200h)', 'Dedicated support', 'Custom profiles'],
      cta: 'Get Ultra', pop: false,
    },
  ];
  return (
    <section style={{ padding: '100px 0' }}>
      <div style={wrap}>
        <SectionHead
          label="Pricing"
          title={<>Simple,<br /><Grad ac={ac}>transparent pricing.</Grad></>}
          sub="All plans include a 7-day free trial. Cancel anytime, no questions asked."
          ac={ac} c={c}
        />
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 24, marginTop: 60, alignItems: 'start' }}>
          {plans.map((p, i) => <PricingCard key={i} plan={p} ac={ac} c={c} dark={dark} />)}
        </div>
      </div>
    </section>
  );
}

/* ─── Testimonials ───────────────────────────────────────────────────────── */

function ReviewCard({ r, c }) {
  return (
    <div style={{
      padding: '28px', borderRadius: 18,
      background: c.card, border: `1px solid ${c.border}`,
    }}>
      <div style={{ display: 'flex', gap: 1, marginBottom: 16, color: '#fbbf24', fontSize: 16 }}>
        {'★'.repeat(r.rating)}
      </div>
      <p style={{ fontSize: 15, lineHeight: 1.75, color: c.sub, margin: '0 0 20px', fontStyle: 'italic' }}>
        "{r.text}"
      </p>
      <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
        <div style={{
          width: 40, height: 40, borderRadius: '50%',
          background: `linear-gradient(135deg,${r.col},${r.col}88)`,
          display: 'flex', alignItems: 'center', justifyContent: 'center',
          fontSize: 16, fontWeight: 700, color: '#fff', flexShrink: 0,
        }}>{r.avatar}</div>
        <div>
          <div style={{ fontSize: 14, fontWeight: 700 }}>{r.name}</div>
          <div style={{ fontSize: 12, color: c.dim }}>{r.role}</div>
        </div>
      </div>
    </div>
  );
}

function DesktopTestimonials({ ac, c, wrap }) {
  const reviews = [
    {
      name: 'Marcus T.', role: 'Sports Fan', avatar: 'M', col: '#ef4444', rating: 5,
      text: 'I cancelled my cable subscription after the first week. Empier has every sports channel I need — live, in HD, on my TV and my phone.',
    },
    {
      name: 'Sofia L.', role: 'Family of 4', avatar: 'S', col: '#8b5cf6', rating: 5,
      text: 'The parental controls are excellent, and 3 simultaneous streams means everyone in the house can watch what they want. Total game-changer.',
    },
    {
      name: 'Ahmed K.', role: 'Expat in London', avatar: 'A', col: '#10b981', rating: 5,
      text: 'Finally I can watch Arabic and French channels without a satellite dish. The international selection is incredible and setup took 10 minutes.',
    },
  ];
  return (
    <section style={{ padding: '100px 0', background: c.altBg }}>
      <div style={wrap}>
        <SectionHead
          label="Reviews"
          title={<>Loved by<br /><Grad ac={ac}>50,000+ subscribers.</Grad></>}
          sub="Don't just take our word for it — here's what real subscribers say."
          ac={ac} c={c}
        />
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 24, marginTop: 60 }}>
          {reviews.map((r, i) => <ReviewCard key={i} r={r} c={c} />)}
        </div>
      </div>
    </section>
  );
}

/* ─── CTA Banner ─────────────────────────────────────────────────────────── */

function DesktopCta({ ac, c, wrap }) {
  return (
    <section style={{ padding: '112px 0', position: 'relative', overflow: 'hidden' }}>
      <div style={{
        position: 'absolute', inset: 0,
        background: `radial-gradient(ellipse at 50% 60%, ${ac.subtle}, transparent 70%)`,
      }} />
      <div style={{ ...wrap, position: 'relative', textAlign: 'center' }}>
        <div style={{
          display: 'inline-flex', alignItems: 'center', gap: 8,
          padding: '6px 16px', borderRadius: 99,
          background: ac.subtle, border: `1px solid ${ac.glow}`,
          color: ac.light, fontSize: 13, fontWeight: 600, marginBottom: 30,
        }}>🚀 Start streaming in under 5 minutes</div>

        <h2 style={{
          fontSize: 60, fontWeight: 900, letterSpacing: '-2px',
          lineHeight: 1.06, margin: '0 0 22px',
          fontFamily: "'Inter', sans-serif",
        }}>
          Ready to cut the cord?<br />
          <Grad ac={ac}>Start your free trial today.</Grad>
        </h2>

        <p style={{ fontSize: 18, color: c.sub, maxWidth: 460, margin: '0 auto 44px', lineHeight: 1.7 }}>
          7 days free. No credit card required. Cancel anytime.
        </p>

        <div style={{ display: 'flex', justifyContent: 'center', gap: 16 }}>
          <Btn label="Start Free Trial →" primary ac={ac} c={c} style={{ fontSize: 16, padding: '15px 30px' }} />
          <Btn label="View All Plans" ac={ac} c={c} style={{ fontSize: 16, padding: '15px 30px' }} />
        </div>
      </div>
    </section>
  );
}

/* ─── Footer ─────────────────────────────────────────────────────────────── */

function DesktopFooter({ ac, c, wrap }) {
  const cols = {
    Product:  ['Features', 'Channels', 'Pricing', "What's New"],
    Support:  ['Help Center', 'Contact Us', 'Status Page', 'API Docs'],
    Company:  ['About', 'Blog', 'Careers', 'Press'],
    Legal:    ['Privacy Policy', 'Terms of Service', 'Cookie Policy'],
  };
  return (
    <footer style={{ borderTop: `1px solid ${c.border}`, padding: '64px 0 32px', background: c.footerBg }}>
      <div style={wrap}>
        <div style={{ display: 'flex', gap: 72, marginBottom: 56 }}>
          {/* Brand */}
          <div style={{ flex: '0 0 210px' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: 10, marginBottom: 16 }}>
              <div style={{
                width: 32, height: 32, borderRadius: 8,
                background: ac.grad, display: 'flex',
                alignItems: 'center', justifyContent: 'center',
                fontWeight: 900, fontSize: 17, color: '#fff',
              }}>E</div>
              <span style={{ fontWeight: 800, fontSize: 18, letterSpacing: '-0.5px' }}>Empier</span>
            </div>
            <p style={{ fontSize: 14, color: c.sub, lineHeight: 1.7, maxWidth: 175, margin: 0 }}>
              The next generation IPTV platform for every screen and every family.
            </p>
          </div>

          {/* Link columns */}
          {Object.entries(cols).map(([group, items]) => (
            <div key={group} style={{ flex: 1 }}>
              <div style={{
                fontSize: 11, fontWeight: 700, color: c.dim,
                textTransform: 'uppercase', letterSpacing: '0.1em', marginBottom: 16,
              }}>{group}</div>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 11 }}>
                {items.map(item => (
                  <a key={item} style={{ fontSize: 14, color: c.sub, textDecoration: 'none', cursor: 'pointer', transition: 'color 0.18s' }}
                    onMouseEnter={e => e.target.style.color = c.text}
                    onMouseLeave={e => e.target.style.color = c.sub}
                  >{item}</a>
                ))}
              </div>
            </div>
          ))}
        </div>

        <div style={{
          paddingTop: 24, borderTop: `1px solid ${c.border}`,
          display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        }}>
          <span style={{ fontSize: 13, color: c.dim }}>© 2024 Empier. All rights reserved.</span>
          <div style={{ display: 'flex', gap: 18 }}>
            {['Twitter', 'Discord', 'YouTube', 'Telegram'].map(s => (
              <a key={s} style={{ fontSize: 13, color: c.dim, textDecoration: 'none', cursor: 'pointer', transition: 'color 0.18s' }}
                onMouseEnter={e => e.target.style.color = c.text}
                onMouseLeave={e => e.target.style.color = c.dim}
              >{s}</a>
            ))}
          </div>
        </div>
      </div>
    </footer>
  );
}

/* ─── Root component ─────────────────────────────────────────────────────── */

function EmpierDesktopLanding({ tweaks = {} }) {
  const ac   = ACCENTS[tweaks.accent] || ACCENTS.violet;
  const dark = tweaks.theme !== 'light';

  const c = {
    bg:       dark ? '#0a0712' : '#f9f8ff',
    altBg:    dark ? '#0f0c1a' : '#ede8ff',
    statsBg:  dark ? 'rgba(255,255,255,0.02)' : 'rgba(0,0,0,0.02)',
    footerBg: dark ? 'rgba(0,0,0,0.25)' : 'rgba(0,0,0,0.02)',
    navBg:    dark ? 'rgba(10,7,18,0.88)' : 'rgba(249,248,255,0.88)',
    card:     dark ? 'rgba(255,255,255,0.04)' : 'rgba(0,0,0,0.03)',
    card2:    dark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)',
    border:   dark ? 'rgba(255,255,255,0.09)' : 'rgba(0,0,0,0.09)',
    text:     dark ? '#f4f2f8' : '#1a1525',
    sub:      dark ? 'rgba(244,242,248,0.55)' : 'rgba(26,21,37,0.55)',
    dim:      dark ? 'rgba(244,242,248,0.30)' : 'rgba(26,21,37,0.30)',
  };

  const wrap = { maxWidth: 1280, margin: '0 auto', padding: '0 64px' };

  return (
    <div style={{ background: c.bg, color: c.text, fontFamily: "'Inter', system-ui, sans-serif", lineHeight: 1 }}>
      <DesktopNavbar ac={ac} c={c} />
      <DesktopHero   ac={ac} dark={dark} c={c} wrap={wrap} />
      <DesktopStats  ac={ac} c={c} wrap={wrap} />
      <DesktopFeatures    ac={ac} c={c} wrap={wrap} />
      <DesktopChannels    ac={ac} c={c} wrap={wrap} />
      <DesktopPricing     ac={ac} c={c} dark={dark} wrap={wrap} />
      <DesktopTestimonials ac={ac} c={c} wrap={wrap} />
      <DesktopCta    ac={ac} c={c} wrap={wrap} />
      <DesktopFooter ac={ac} c={c} wrap={wrap} />
    </div>
  );
}
