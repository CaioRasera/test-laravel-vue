<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 p-4 md:p-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Posts</h1>
      <button 
        @click="logout"
        class="flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 transition"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
        </svg>
        Sair
      </button>
    </div>

    <div class="fixed bottom-8 right-8 z-50">
      <button
        v-if="props.isAdmin && !showForm"
        @click="showForm = true"
        class="bg-blue-600 text-white p-5 rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-110"
        title="Novo Post"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
      </button>
    </div>

    <transition name="fade">
      <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-md shadow-lg relative">
          <button @click="showForm = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <PostForm @post-created="onPostCreated" />
        </div>
      </div>
    </transition>

    <transition name="fade">
      <div v-if="successMsg" class="fixed top-8 right-8 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50">
        {{ successMsg }}
      </div>
    </transition>

    <PostList :posts="posts" :isAdmin="props.isAdmin" @post-deleted="onPostDeleted" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import PostForm from '../Components/PostForm.vue'
import PostList from '../Components/PostList.vue'

const props = defineProps({
  posts: Array,
  isAdmin: Boolean
})

const showForm = ref(false)
const successMsg = ref('')
const posts = ref(props.posts)

const onPostCreated = (post) => {
  showForm.value = false
  successMsg.value = 'Post criado com sucesso!'
  posts.value = [post, ...posts.value]
  setTimeout(() => successMsg.value = '', 2500)
}

const onPostDeleted = (id) => {
  successMsg.value = 'Post excluído com sucesso!'
  posts.value = posts.value.filter(p => p.id !== id)
  setTimeout(() => successMsg.value = '', 2500)
}

const logout = () => {
  router.post(route('logout'), {}, {
    onFinish: () => {
      window.location.href = '/login'
    }
  })
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>