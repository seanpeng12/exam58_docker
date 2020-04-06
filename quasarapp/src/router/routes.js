const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/index.vue") }],
  },
  {
    path: "/arrange-schedule",
    component: () => import("pages/arrange-schedule.vue"),
    // children: [{ path: "", component: () => import("pages/class.vue") }]
  },
  {
    path: "/PageAuth",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/PageAuth.vue") }],
  },
  {
    path: "/mySchedule",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/mySchedule.vue") }],
  },
  {
    path: "/Like",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/LikeCard.vue") }],
  },
];

// Always leave this as last one
if (process.env.MODE !== "ssr") {
  routes.push({
    path: "*",
    component: () => import("pages/Error404.vue"),
  });
}

export default routes;
