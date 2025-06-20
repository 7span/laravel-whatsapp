import { defineConfig } from 'vitepress'

export default defineConfig({
  title: "Laravel WhatsApp",
  description: "A Laravel package for integrating WhatsApp messaging functionality into your applications",
  srcDir: "src",
  head: [["link", { rel: "icon", type: "image/svg+xml", href: "/logo.svg" }]],
  base: '/open-source/laravel-whatsapp/',
  themeConfig: {
    siteTitle: "Laravel WhatsApp",
    logo: "/logo.svg",
    nav: [
      { text: "Home", link: "/index" },
    ],
    sidebar: [
      {
        text: "Introduction",
        items: [
          { text: "Why Laravel WhatsApp?", link: "/introduction/why-laravel-whatsapp" }
          
        ]
      },
      {
        text: "Getting Started",
        items: [
          { text: "Installation", link: "/getting-started/installation" },
          { text: "Configuration", link: "/getting-started/configuration" }
        ]
      },
      {
        text: "Usage",
        items: [
          { text: "Phone Numbers", link: "/usage/get-phone-numbers" },
          { text: "Basic Templates", link: "/usage/basic-templates" },
          { text: "Advanced Templates", link: "/usage/advanced-templates" },
        ]
      }
    ],
    socialLinks: [
      { icon: "github", link: "https://github.com/7span/laravel-whatsapp" }
    ],
    footer: {
      message: "Released under the MIT License.",
      copyright: "Copyright © 2024"
    },
    search: {
      provider: "local"
    }
  }
})
