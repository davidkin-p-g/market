<template>
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-md-8">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Example Component</div>-->

<!--                    <div class="card-body">-->
<!--                        I'm an example component.-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Example Component</div>-->

<!--                    <div class="card-body">-->
<!--                        I'm an example component.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="row row-cols-1 row-cols-md-3 g-4" style = "margin-top: 5%">

        <div class="col">
            <div class="card h-100">
<!--                <img src="..." class="card-img-top" alt="...">-->
                <div class="card-body">
                    <h2 class="card-title text-center">Квоты</h2>
                    <p class="card-text">
                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
<!--                <img src="..." class="card-img-top" alt="...">-->
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
<!--                <img src="..." class="card-img-top" alt="...">-->
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
