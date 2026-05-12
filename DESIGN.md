---
name: Velocity Reserve
colors:
  surface: '#fcf9f8'
  surface-dim: '#dcd9d9'
  surface-bright: '#fcf9f8'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f6f3f2'
  surface-container: '#f0eded'
  surface-container-high: '#eae7e7'
  surface-container-highest: '#e5e2e1'
  on-surface: '#1b1c1c'
  on-surface-variant: '#5b403d'
  inverse-surface: '#303030'
  inverse-on-surface: '#f3f0ef'
  outline: '#8f6f6c'
  outline-variant: '#e4beba'
  surface-tint: '#ba1a20'
  primary: '#af101a'
  on-primary: '#ffffff'
  primary-container: '#d32f2f'
  on-primary-container: '#fff2f0'
  inverse-primary: '#ffb3ac'
  secondary: '#7a5459'
  on-secondary: '#ffffff'
  secondary-container: '#fdcbd0'
  on-secondary-container: '#795358'
  tertiary: '#005f7b'
  on-tertiary: '#ffffff'
  tertiary-container: '#00799c'
  on-tertiary-container: '#e9f7ff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdad6'
  primary-fixed-dim: '#ffb3ac'
  on-primary-fixed: '#410003'
  on-primary-fixed-variant: '#930010'
  secondary-fixed: '#ffd9dd'
  secondary-fixed-dim: '#ebbabf'
  on-secondary-fixed: '#2f1317'
  on-secondary-fixed-variant: '#603d42'
  tertiary-fixed: '#bee9ff'
  tertiary-fixed-dim: '#7bd1f8'
  on-tertiary-fixed: '#001f2a'
  on-tertiary-fixed-variant: '#004d65'
  background: '#fcf9f8'
  on-background: '#1b1c1c'
  surface-variant: '#e5e2e1'
typography:
  h1:
    fontFamily: Lexend
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  h2:
    fontFamily: Lexend
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
    letterSpacing: -0.01em
  h3:
    fontFamily: Lexend
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  xl: 80px
  container-max: 1280px
  gutter: 24px
---

## Brand & Style

The brand personality is energetic, precise, and high-performance. It targets active individuals and amateur athletes who value efficiency and professional-grade experiences. The UI evokes a sense of urgency and excitement through its color palette, balanced by a clean, minimalist structure that ensures trust and clarity.

The chosen design style is **Modern Minimalist with Tonal Depth**. By utilizing heavy whitespace and a restricted color palette, the system directs focus toward action (booking). The aesthetic is professional and systematic, drawing inspiration from high-end athletic apparel and modern SaaS platforms to ensure the booking process feels as fast as the sports being played.

## Colors

The color palette is dominated by a high-energy Red, utilized strategically to drive conversions and highlight availability. 

- **Primary (#D32F2F):** Used for main action buttons, active states, and critical branding elements.
- **Secondary (#FFCDD2):** Applied to backgrounds for cards, tags, or subtle hover states to soften the intensity of the primary red.
- **Accent (#B71C1C):** Reserved for deep contrast, hover states on primary buttons, and critical alerts.
- **Background (#FFFFFF):** Provides a clean, breathable canvas that emphasizes the vibrant red accents.
- **Neutral (#212121):** Ensuring high legibility for typography and icon paths.

## Typography

This design system utilizes a pairing of **Lexend** and **Inter**. Lexend is specifically chosen for headings due to its athletic, highly readable, and motivating character, which aligns perfectly with sports venue booking. Inter serves as the workhorse for all functional UI elements, body copy, and data-heavy tables, providing a neutral and systematic foundation.

Headlines should be tight and bold to convey strength. Body text maintains generous line heights to ensure readability during quick mobile browsing.

## Layout & Spacing

The system employs a **Fixed Grid** model for desktop, transitioning to a fluid single-column layout for mobile. 

- **Desktop:** A 12-column grid with a 1280px max-width container. 24px gutters provide ample separation between venue cards and booking slots.
- **Mobile:** A flexible 4-column grid with 16px side margins.
- **Rhythm:** An 8px linear scale governs all padding and margins, ensuring a consistent vertical rhythm. Use larger spacing (48px+) to separate distinct sections like "Featured Venues" and "Recent Bookings."

## Elevation & Depth

Hierarchy is established through **Ambient Shadows** and tonal layering. 

- **Surface Levels:** The main background is pure white. Secondary containers (like search bars or filters) use a subtle grey or the secondary soft red tint to recede.
- **Shadows:** Use highly diffused, low-opacity shadows (e.g., `0 4px 20px rgba(211, 47, 47, 0.08)`) for interactive cards. The shadow should have a very slight red tint to harmonize with the primary color palette.
- **Interaction:** Upon hover, elevations should slightly increase, and the shadow should become slightly more pronounced to provide tactile feedback without looking heavy.

## Shapes

The design system adopts a **Rounded** shape language. This softens the intensity of the dominant red and makes the interface feel more approachable and modern. 

- **Standard Elements:** Buttons and input fields use a 0.5rem (8px) radius.
- **Large Containers:** Cards and modal overlays use a 1rem (16px) radius to create a distinct, modern "object" feel.
- **Full Rounding:** Pills are used for status indicators (e.g., "Available", "Booked") and category filters to distinguish them from actionable buttons.

## Components

- **Buttons:** Primary buttons are solid #D32F2F with white text. Secondary buttons use a #FFCDD2 background with #B71C1C text. Ghost buttons use an outline of the primary red.
- **Cards:** Venue cards feature a top-aligned image, 1rem corner radius, and a subtle ambient shadow. Information is organized with H3 titles and body-md metadata.
- **Input Fields:** Search and date pickers use a 1px border (#E0E0E0) that transitions to #D32F2F on focus. Soft red (#FFCDD2) is used for the background of the input on hover.
- **Chips/Filters:** Categorical filters (e.g., "Tennis", "Indoor") use the pill shape. Active states use primary red with white text; inactive states use white with a light grey border.
- **Booking Calendar:** A custom grid component using #FFCDD2 for available slots and #B71C1C for the selected slot, ensuring the red theme remains functional and clear.
- **Progress Steppers:** Horizontal line-based steppers with circular nodes, utilizing the primary red to indicate the current step in the booking flow.