<template>
    <div class="my-gallery">
        <input type="file" style="display: none" id="vue-gal-input">
        <dropzone :input-text="dropText" class="my-gallery__dropzone" v-on:file="dropHandler"/>
        <draggable class="my-gallery__images" v-model="images" @end="reSort">
            <div class="my-gallery__images__item" v-for="(element, key) in images" :key="element.id"
                 :style="'max-width:' + maxWidth">
                <img :src="element.image" :govno="element.id" alt="">
                <div @click="removeImage(key,element.id)" class="remove">
                    <svg height="24px" viewBox="-40 0 427 427.00131" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="m232.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m114.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m28.398438 127.121094v246.378906c0 14.5625 5.339843 28.238281 14.667968 38.050781 9.285156 9.839844 22.207032 15.425781 35.730469 15.449219h189.203125c13.527344-.023438 26.449219-5.609375 35.730469-15.449219 9.328125-9.8125 14.667969-23.488281 14.667969-38.050781v-246.378906c18.542968-4.921875 30.558593-22.835938 28.078124-41.863282-2.484374-19.023437-18.691406-33.253906-37.878906-33.257812h-51.199218v-12.5c.058593-10.511719-4.097657-20.605469-11.539063-28.03125-7.441406-7.421875-17.550781-11.5546875-28.0625-11.46875h-88.796875c-10.511719-.0859375-20.621094 4.046875-28.0625 11.46875-7.441406 7.425781-11.597656 17.519531-11.539062 28.03125v12.5h-51.199219c-19.1875.003906-35.394531 14.234375-37.878907 33.257812-2.480468 19.027344 9.535157 36.941407 28.078126 41.863282zm239.601562 279.878906h-189.203125c-17.097656 0-30.398437-14.6875-30.398437-33.5v-245.5h250v245.5c0 18.8125-13.300782 33.5-30.398438 33.5zm-158.601562-367.5c-.066407-5.207031 1.980468-10.21875 5.675781-13.894531 3.691406-3.675781 8.714843-5.695313 13.925781-5.605469h88.796875c5.210937-.089844 10.234375 1.929688 13.925781 5.605469 3.695313 3.671875 5.742188 8.6875 5.675782 13.894531v12.5h-128zm-71.199219 32.5h270.398437c9.941406 0 18 8.058594 18 18s-8.058594 18-18 18h-270.398437c-9.941407 0-18-8.058594-18-18s8.058593-18 18-18zm0 0"/><path d="m173.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/></svg>
                </div>
                <div @click="changeImage(element.id)" class="edit">
                    <svg height="24px" viewBox="0 0 512 511" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="m405.332031 256.484375c-11.796875 0-21.332031 9.558594-21.332031 21.332031v170.667969c0 11.753906-9.558594 21.332031-21.332031 21.332031h-298.667969c-11.777344 0-21.332031-9.578125-21.332031-21.332031v-298.667969c0-11.753906 9.554687-21.332031 21.332031-21.332031h170.667969c11.796875 0 21.332031-9.558594 21.332031-21.332031 0-11.777344-9.535156-21.335938-21.332031-21.335938h-170.667969c-35.285156 0-64 28.714844-64 64v298.667969c0 35.285156 28.714844 64 64 64h298.667969c35.285156 0 64-28.714844 64-64v-170.667969c0-11.796875-9.539063-21.332031-21.335938-21.332031zm0 0"/><path d="m200.019531 237.050781c-1.492187 1.492188-2.496093 3.390625-2.921875 5.4375l-15.082031 75.4375c-.703125 3.496094.40625 7.101563 2.921875 9.640625 2.027344 2.027344 4.757812 3.113282 7.554688 3.113282.679687 0 1.386718-.0625 2.089843-.210938l75.414063-15.082031c2.089844-.429688 3.988281-1.429688 5.460937-2.925781l168.789063-168.789063-75.414063-75.410156zm0 0"/><path d="m496.382812 16.101562c-20.796874-20.800781-54.632812-20.800781-75.414062 0l-29.523438 29.523438 75.414063 75.414062 29.523437-29.527343c10.070313-10.046875 15.617188-23.445313 15.617188-37.695313s-5.546875-27.648437-15.617188-37.714844zm0 0"/></svg>
                </div>
            </div>
        </draggable>
        <div v-if="!images[0]" class="my-gallery__empty">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                 width="50px" height="50px" viewBox="0 0 452.000000 452.000000"
                 preserveAspectRatio="xMidYMid meet">
                <metadata>
                    Created by potrace 1.16, written by Peter Selinger 2001-2019
                </metadata>
                <g transform="translate(0.000000,452.000000) scale(0.100000,-0.100000)"
                   fill="#000000" stroke="none">
                    <path d="M22 4497 c-16 -17 -22 -36 -22 -68 l0 -44 2193 -2193 2192 -2192 46
0 c61 0 89 28 89 91 0 43 -2 45 -157 201 l-158 158 43 0 c32 0 49 6 67 25 l25
24 0 1310 0 1309 -31 26 c-29 25 -37 26 -140 26 l-109 0 0 -95 0 -95 45 0 45
0 0 -1170 0 -1170 -68 0 -67 0 -130 130 -130 130 38 0 c29 0 46 7 68 29 l29
29 0 1302 0 1302 -29 29 c-29 29 -31 29 -140 29 l-111 0 0 -95 0 -95 45 0 45
0 0 -1170 0 -1170 -68 0 -67 0 -129 129 -128 128 44 6 c29 4 50 14 65 32 l23
26 0 1299 0 1298 -26 31 -26 31 -1401 0 -1402 0 -225 225 -225 225 -46 0 c-35
0 -51 -5 -67 -23z m3228 -1354 l0 -738 -237 237 c-131 130 -249 241 -262 248
-52 26 -77 9 -266 -180 l-180 -180 -500 500 c-478 477 -502 500 -537 500 -24
0 -46 -8 -65 -24 l-29 -25 -200 200 -199 199 1238 0 1237 0 0 -737z m-268
-750 l268 -268 0 -292 0 -293 -67 0 -68 0 -382 382 -383 383 177 177 c98 98
180 178 183 178 3 0 125 -120 272 -267z"/>
                    <path d="M2640 3609 c-32 -13 -78 -56 -96 -91 -20 -38 -18 -126 4 -167 63
-125 243 -135 320 -18 22 33 27 52 27 102 0 50 -5 69 -27 102 -45 69 -151 102
-228 72z"/>
                    <path d="M180 2683 l0 -1281 31 -26 31 -26 1276 0 1277 0 -95 95 -95 95 -1117
0 -1118 0 0 475 0 474 333 302 c182 167 334 304 337 306 2 2 -27 35 -65 73
l-70 70 -265 -242 -265 -242 -3 510 -2 510 -95 94 -95 95 0 -1282z"/>
                    <path d="M1925 2150 c-93 -97 44 -226 138 -131 l32 31 -65 65 c-35 36 -67 65
-70 65 -4 0 -19 -14 -35 -30z"/>
                    <path d="M630 1069 c0 -109 0 -111 29 -140 l29 -29 1279 0 1278 0 -95 95 -95
95 -1117 0 -1118 0 0 45 0 45 -95 0 -95 0 0 -111z"/>
                    <path d="M1080 621 c0 -103 1 -111 26 -140 l26 -31 1281 0 1282 0 -95 95 -95
95 -1117 0 -1118 0 0 45 0 45 -95 0 -95 0 0 -109z"/>
                </g>
            </svg>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import dropzone from './dropzone.vue'

    export default {
        components: {
            draggable,
            dropzone
        },
        name: "gallery",
        data() {
            return {
                uploadForId: Number,
                images: [],
                removedImages: [],
            }
        },
        computed: {
            sortedArray: function () {
                return this.imagesData;
            }
        },
        beforeMount() {
            if (Array.isArray(this.imagesData)) {
                this.images = this.imagesData.sort((a, b) => {
                    return a.sortOrder - b.sortOrder
                });
            } else {
                if (this.imagesData != null && this.imagesData != "null" && this.imagesData != undefined && this.imagesData != '') {
                    this.images = JSON.parse(this.imagesData);
                }
            }

            this.images.sort((a, b) => {
                return a.sortOrder - b.sortOrder
            });
        },
        props: {
            resultId: String,
            imagesData: {},
            maxWidth: {
                default: "200px"
            },
            emptyText: {
                default: "Gallery is empty"
            },
            dropText: {
                default: "Upload images"
            }
        },
        methods: {
            dropHandler(file) {
                let id = 0;
                this.images.forEach(function (el) {
                    if (el.id < id) {
                        id = el.id;
                    }
                });
                this.images.unshift({id: --id, sortOrder: 0, image: file});

                this.reSort();
            },
            updateResult() {
                if (this.resultId !== null && this.resultId !== '') {
                    let el = document.getElementById(this.resultId);
                    if (el) {

                        let added = [];
                        this.images.forEach(function (img) {
                            if (img.id < 0) {
                                added.unshift({image: img.image, sortOrder: img.sortOrder});
                            }
                        });

                        let old = [];
                        this.images.forEach(function (img) {
                            if (img.id > 0) {
                                old.unshift({id: img.id, sortOrder: img.sortOrder});
                            }
                        });

                        let result = {removed: this.removedImages, added: added, old: old};
                        //el.value = btoa(JSON.stringify(result));
                        el.value = JSON.stringify(result);
                    }
                }
            },
            handleFileChange(e) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = (evt) => {
                    let img = this.images.find((el) => {
                        return el.id == this.uploadForId
                    })
                    img.image = evt.target.result;

                    let id = 0;
                    this.images.forEach(function (el) {
                        if (el.id < id) {
                            id = el.id;
                        }
                    });

                    img.id = --id;

                    if (this.uploadForId > 0) {
                        this.removedImages.push(this.uploadForId);
                    }

                    this.updateResult();
                };
                reader.readAsDataURL(file);
            },
            changeImage(idx) {
                this.uploadForId = idx;
                let input = document.getElementById("vue-gal-input");
                input.setAttribute("type", "file");
                input.setAttribute("accept", "image/*");
                input.onchange = this.handleFileChange;
                input.click();
            },
            removeImage: function (idx, id) {
                this.$delete(this.images, idx);
                if (id > 0) {
                    this.removedImages.push(id);
                }
                this.reSort();
                this.updateResult();
            },
            reSort: function () {
                for (let i = 0; i < this.images.length; i++) {
                    this.images[i].sortOrder = i;
                }
                this.updateResult();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .my-gallery {

        &__empty {
            height: 100px;
            /*background-color: #dddddd;*/
            margin: 15px;
            font-size: 30px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        &__images {
            display: flex;
            flex-wrap: wrap;
            overflow: auto;
            max-height: calc(100% - 100px);
            margin: 15px;

            &__item {
                padding: 10px;
                border: solid 1px #dddddd;
                border-radius: 15px;
                margin: 5px;
                position: relative;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;

                img {
                    max-width: 100%;
                    width: 100%;
                    height: auto;
                }

                .remove {
                    width: 15%;
                    height: auto;
                    position: absolute;
                    cursor: pointer;
                    top: 1%;
                    right: 1%;
                }

                .edit {
                    width: 15%;
                    height: auto;
                    position: absolute;
                    cursor: pointer;
                    top: 1%;
                    right: 17%;
                }
            }
        }
    }
</style>