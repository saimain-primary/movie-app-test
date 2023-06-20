import axios from "axios";
import { defineStore } from "pinia";

export const useMovieStore = defineStore("movie", {
    state: () => ({
        movies: null,
        tags: null,
        authors: null,
        genres: null,
    }),
    getters: {},
    actions: {
        async getTagListAction() {
            try {
                const { data } = await axios.get(
                    "http://localhost:8000/api/tags"
                );
                this.tags = data.result;
            } catch (error) {
                console.log(error);
            }
        },
        async getAuthorListAction() {
            try {
                const { data } = await axios.get(
                    "http://localhost:8000/api/authors"
                );
                this.authors = data.result;
            } catch (error) {
                console.log(error);
            }
        },
        async getGenresListAction() {
            try {
                const { data } = await axios.get(
                    "http://localhost:8000/api/genres"
                );
                this.genres = data.result;
            } catch (error) {
                console.log(error);
            }
        },
        async getMovieListAction(params) {
            try {
                const { data } = await axios.get(
                    "http://localhost:8000/api/movies",
                    { params: params }
                );
                this.movies = data.result;
            } catch (error) {
                console.log(error);
            }
        },
        async storeMovieAction(body) {
            try {
                const { data } = await axios.post(
                    "http://localhost:8000/api/movies",
                    body
                );
            } catch (error) {
                console.log(error);
            }
        },
        async deleteMovieAction(id) {
            try {
                const { data } = await axios.delete(
                    "http://localhost:8000/api/movies/" + id
                );
                console.log(
                    "🚀 ~ file: movie.js:36 ~ deleteMovieAction ~ data:",
                    data
                );
            } catch (error) {
                console.log(error);
            }
        },
        async getMovieDetailAction(id) {
            try {
                const { data } = await axios.get(
                    "http://localhost:8000/api/movies/" + id
                );
                return data.result;
            } catch (error) {
                console.log(error);
            }
        },
        async updateMovieAction(id, body) {
            try {
                const { data } = await axios.post(
                    "http://localhost:8000/api/movies/" + id,
                    body
                );
                console.log(
                    "🚀 ~ file: movie.js:93 ~ updateMovieAction ~ data:",
                    data
                );
            } catch (error) {
                console.log(error);
            }
        },
        async addCommentAction(id, body) {
            try {
                const { data } = await axios.post(
                    "http://localhost:8000/api/movies/" + id + "/comments",
                    body
                );
                console.log(
                    "🚀 ~ file: movie.js:93 ~ updateMovieAction ~ data:",
                    data
                );
            } catch (error) {
                console.log(error);
            }
        },
    },
});
