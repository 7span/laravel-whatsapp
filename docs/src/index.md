---
layout: home

hero:
    name: "Laravel WhatsApp"
    text: "WhatsApp Cloud API Integration for Laravel"
    tagline: "Seamless WhatsApp Messaging for Laravel"
    image:
      src: /hero.svg
      alt: Laravel WhatsApp
    actions:
        - theme: brand
          text: Get Started
          link: /introduction/why-laravel-whatsapp
        - theme: alt
          text: View on GitHub
          link: https://github.com/7span/laravel-whatsapp

features:
    - icon: 🔌
      title: Easy Integration
      details: Simple installation and configuration with Laravel's service provider and facade system.
    - icon: 📝
      title: Template Messages
      details: Send WhatsApp template messages with dynamic content, media, and interactive components.
    - icon: ☁️
      title: Cloud API Support
      details: Built on top of WhatsApp Cloud API with support for business accounts.
    - icon: ⚙️
      title: Flexible Configuration
      details: Configurable settings for API endpoints, business accounts, and message templates.
---

<script setup>
import { VPTeamMembers } from 'vitepress/theme'

const members = [
  {
    avatar: 'https://github.com/7span.png',
    name: '7Span',
    title: 'Sponsor',
    links: [
      { icon: 'github', link: 'https://github.com/7span' },
      { icon: 'x', link: 'https://x.com/7SpanHQ' }
    ]
  },
  {
    avatar: 'https://github.com/hemratna.png',
    name: 'Hemratna Bhimani',
    title: 'Creator',
    links: [
      { icon: 'github', link: 'https://github.com/hemratna' },
    ]
  },
  {
    avatar: 'https://github.com/kajal-7span.png',
    name: 'Kajal Pandya',
    title: 'Contributor',
    links: [
      { icon: 'github', link: 'https://github.com/kajal-7span' },
    ]
  },
  {
    avatar: 'https://github.com/nikunj-7span.png',
    name: 'Nikunj Gadhiya',
    title: 'Contributor',
    links: [
      { icon: 'github', link: 'https://github.com/nikunj-7span' },
    ]
  },
  {
    avatar: 'https://github.com/binal-7span.png',
    name: 'Binal Patel',
    title: 'Contributor',  
    links: [
      { icon: 'github', link: 'https://github.com/binal-7span' },
    ]
  },  {
    avatar: 'https://github.com/urvashi-7span.png',
    name: 'Urvashi Thakar',
    title: 'Contributor',
    links: [
      { icon: 'github', link: 'https://github.com/urvashi-7span' },
    ]
  },
  {
    avatar: 'https://github.com/trushal-7span.png',
    name: 'Trushal Thummar',
    title: 'Contributor',
    links: [
      { icon: 'github', link: 'https://github.com/trushal-7span' }, 
    ]
  },
  {
      avatar: 'https://github.com/jay-r-7span.png',
      name: 'Jay Bharadiya',
      title: 'Contributor',
      links: [
          { icon: 'github', link: 'https://github.com/jay-r-7span' },
      ]  
  }
]
</script>

### 🙌 Credits

> Big thanks to everyone who contributed to making **Laravel WhatsApp** a powerful and easy-to-use package for integrating WhatsApp Cloud API with Laravel applications. This package helps developers seamlessly implement WhatsApp messaging features in their Laravel projects.

<VPTeamMembers size="small" :members />
