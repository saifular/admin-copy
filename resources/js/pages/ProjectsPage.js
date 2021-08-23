import React, {Component, Fragment} from 'react';
import Menu from "../components/Menu";
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import Axios from "axios";
import {Button, Card, Col, Container, Form, Modal, Row, Spinner} from "react-bootstrap";
import LoadingDiv from "../components/loadingDiv";
import WentWrong from "../components/wentWrong";
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
class ProjectsPage extends Component {
    constructor() {
        super();
        this.state={
            dataList:[],
            isLoading:true,
            isError:false,
            rowDataID:"",
            deleteBtnText:"Delete",
            AdNewModal:false,
            title:"",
            price:"",
            special_price:"",
            image:"",
            category:"",
            subcategory:"",
            remark:"",
            brand:"",
            shop:"",
            shop_name:"",
            star:"",
            product_code:"",
            stock:""
        }

        this.dataDelete=this.dataDelete.bind(this);
        this.imgCellFormat=this.imgCellFormat.bind(this);

        this.addNewModalOpen=this.addNewModalOpen.bind(this);
        this.addNewModalClose=this.addNewModalClose.bind(this);

        this.onTitleChangee=this.onTitleChange.bind(this);
        this.onPriceChange=this.onPriceChange.bind(this);
        this.onSpecial_priceChange=this.onSpecial_priceChange.bind(this);
        this.onPhotoOneChange=this.onPhotoOneChange.bind(this);
        this.onCategoryChange=this.onCategoryChange.bind(this);
        this. onSubcategoryChange=this. onSubcategoryChange.bind(this);
        this.onRemarkChange=this.onRemarkChange.bind(this);
        this.onBrandChange=this.onBrandChange.bind(this);
        this.onShopChange=this.onShopChange.bind(this);
        this.onShop_nameChange=this.onShop_nameChange.bind(this);
        this.onStarChange=this.onStarChange.bind(this);
        this.onProduct_codeChange=this.onProduct_codeChange.bind(this);
        this.onStockChange=this.onStockChange.bind(this);

        this.addFormSubmit=this.addFormSubmit.bind(this);



    }



    onTitleChange(event){
            this.setState({title:event.target.value})
    }
    onPriceChange(event){
        this.setState({price:event.target.value})
    }
    onSpecial_priceChange(event){
        this.setState({special_price:event.target.value})
    }
    onPhotoOneChange(event){
        this.setState({image:event.target.files[0]})
    }
    onCategoryChange(event){
        this.setState({category:event.target.value})
   }
   onSubcategoryChange(event){
    this.setState({subcategory:event.target.value})
   }

   onRemarkChange(event){
    this.setState({remark:event.target.value})
   }
   onBrandChange(event){
    this.setState({brand:event.target.value})
   }
   onShopChange(event){
    this.setState({shop:event.target.value})
    }
    onShop_nameChange(event){
        this.setState({shop_name:event.target.value})
       }
    
       onStarChange(event){
        this.setState({star:event.target.value})
       }
       onProduct_codeChange(event){
        this.setState({product_code:event.target.value})
       }
       onStockChange(event){
        this.setState({stock:event.target.value})
        }
    addFormSubmit(event){

        event.preventDefault();

        let title=this.state.title;
        let price=this.state.price;
        let special_price=this.state.special_price;
        let image=this.state.image;
        let category=this.state.category;
        let subcategory=this.state.subcategory;
        let remark=this.state.remark;
        let brand=this.state.brand;
        let shop=this.state.shop;
        let shop_name=this.state.shop_name;
        let star=this.state. star;
        let product_code=this.state.product_code;
        let stock=this.state.stock;
        let myFormData=new FormData();
        myFormData.append('title',title);
        myFormData.append('price',price);
        myFormData.append('special_price',special_price);
        myFormData.append('image',image);
        myFormData.append('categorye',category);
        myFormData.append('subcategory',subcategory);
        myFormData.append('remark',remark);
        myFormData.append('brand',brand);
        myFormData.append('shop',shop);
        myFormData.append('shop_name',shop_name);
        myFormData.append('star',star);
        myFormData.append('product_code',product_code);
        myFormData.append('stock',stock);

        let url="/SendSingupDetails";
        let config={
            headers:{ 'content-type':'multipart/form-data'}
        }




        Axios.post(url,myFormData,config).then((response)=> {
            if(response.data==1){
                toast.success('Create Success', {
                    position: "bottom-center",
                    autoClose: 3000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: false,
                    draggable: true,
                    progress: 0,
                });
                this.addNewModalClose();
                this.componentDidMount();
            }
            else {
                toast.error('Create Fail', {
                    position: "bottom-center",
                    autoClose: 3000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: false,
                    draggable: true,
                    progress: 0,
                });
            }
        }).catch((error)=> {
            toast.error('Create Fail', {
                position: "bottom-center",
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: false,
                draggable: true,
                progress: 0,
            });
        })



    }





    componentDidMount() {
        Axios.get('/ProjectList').then((response)=>{
            if(response.status==200){
                this.setState({dataList:response.data,isLoading:false,isError:false})
            }
            else{
                this.setState({isLoading:false,isError:true})
            }
        }).catch((error)=>{
            this.setState({isLoading:false,isError:true})
        })
    }

    dataDelete(){

        let confirmResult=confirm("Do You Want To Delete ?")
        if(confirmResult===true){
            this.setState({deleteBtnText:"Deleting..."})
            Axios.post('/ProjectDelete',{id:this.state.rowDataID}).then((response)=>{
                if(response.data==1 && response.status==200){
                    toast.success('Delete Success', {
                        position: "bottom-center",
                        autoClose: 3000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: false,
                        draggable: true,
                        progress: 0,
                    });
                    this.setState({deleteBtnText:"Delete"})
                    this.componentDidMount();
                }
                else{
                    toast.error('Delete Fail', {
                        position: "bottom-center",
                        autoClose: 3000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: false,
                        draggable: true,
                        progress: 0,
                    });
                    this.setState({deleteBtnText:"Delete"})
                }


            }).catch((error)=>{
                toast.error('Delete Fail', {
                    position: "bottom-center",
                    autoClose: 3000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: false,
                    draggable: true,
                    progress: 0,
                });
                this.setState({deleteBtnText:"Delete"})
            })
        }

    }

    imgCellFormat(cell,row){
        return(
            <img className="table-cell-img" src={cell}/>
        )
    }

    addNewModalOpen(){
        this.setState({AdNewModal:true});
    }
    addNewModalClose(){
        this.setState({AdNewModal:false});
    }





    render() {
        if(this.state.isLoading==true){
            return (
                <Menu title="Projects">
                    <Container>
                        <LoadingDiv/>
                    </Container>
                </Menu>
            )
        }
        else if(this.state.isError==true){
            return (
                <Menu title="Projects">
                    <Container>
                        <WentWrong/>
                    </Container>
                </Menu>
            )
        }else{



            const data = this.state.dataList;
            const columns=[
                {dataField: 'id', text: 'ID'},
                {dataField: 'title', text: 'Title'},
                {dataField: 'price', text: 'Price'},
                {dataField: 'special_price', text: 'Special_price'},
                {dataField: 'image', text: 'Image',formatter:this.imgCellFormat},
                {dataField: 'category', text: 'Category'},
                {dataField: 'subcategory', text: 'Subcategory'},
                {dataField: 'remark', text: 'Remark'},
                {dataField: 'brand', text: 'Brand'},
                {dataField: 'shop', text: 'Shop'},
                {dataField: 'shop_name', text: 'Shop_name'},
                {dataField: 'star', text: 'Star'},
                {dataField: 'product_code', text: 'Product_code'},
                {dataField: 'stock', text: 'Stock'},
            ]
            const selectRow={
                mode:'radio',
                onSelect:(row,isSelect,rowIndex)=>{
                    this.setState({rowDataID:row['id']})
                }
            }

            return (
                <Fragment>
                    <Menu title="Projects">
                        <Container fluid={true}>
                            <Row>
                                <Col md={12} sm={12} lg={12}>
                                    <Card>
                                        <Card.Body>
                                            <button onClick={this.dataDelete} className="normal-btn  my-2 btn">{this.state.deleteBtnText}</button>
                                            <button onClick={this.addNewModalOpen} className="normal-btn ml-3 my-2 btn">Add New</button>
                                            <BootstrapTable
                                                keyField='id'
                                                data={ data }
                                                columns={ columns }
                                                selectRow={selectRow}
                                                pagination={ paginationFactory() }>
                                            </BootstrapTable>
                                        </Card.Body>
                                    </Card>
                                </Col>
                            </Row>
                            <ToastContainer
                                position="bottom-center"
                                autoClose={3000}
                                hideProgressBar={false}
                                newestOnTop={false}
                                closeOnClick
                                rtl={false}
                                pauseOnFocusLoss={false}
                                draggable
                                pauseOnHover={false}
                            />

                        </Container>
                    </Menu>

                    <Modal  scrollable={true} size="lg" show={this.state.AdNewModal} onHide={this.addNewModalClose}>
                        <Modal.Header closeButton>
                            <h6>Add New Project</h6>
                        </Modal.Header>
                        <Modal.Body>
                            <Form onSubmit={this.addFormSubmit}>
                                <Form.Group >
                                    <Form.Label>Title</Form.Label>
                                    <Form.Control onChange={this.onTitleChange} type="text" placeholder="Title" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Price</Form.Label>
                                    <Form.Control  onChange={this.onPriceChange} type="text" placeholder="Price" />
                                </Form.Group>

                                <Form.Group className="mb-5" >
                                    <Form.Label>Special_price</Form.Label>
                                    <Form.Control  onChange={this.onSpecial_priceChange} type="text" placeholder="Special_price" />
                                </Form.Group>

                                <Form.Group >
                                    <Form.Label>Image</Form.Label>
                                    <Form.Control onChange={this.onPhotoOneChange} type="file" />
                                </Form.Group>

                                <Form.Group >
                                    <Form.Label>Category</Form.Label>
                                    <Form.Control  onChange={this.onCategoryChange} type="text" placeholder="Category" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Subcategory</Form.Label>
                                    <Form.Control  onChange={this.onSubcategoryChange} type="text" placeholder="Subcategory" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Remark</Form.Label>
                                    <Form.Control  onChange={this.onRemarkChange} type="text" placeholder="Remark" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Brand</Form.Label>
                                    <Form.Control  onChange={this.onBrandChange} type="text" placeholder="Brand" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Shop</Form.Label>
                                    <Form.Control  onChange={this.onShopChange} type="text" placeholder="Shop" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Shop_name</Form.Label>
                                    <Form.Control  onChange={this.onShop_nameChange} type="text" placeholder="Shop_name" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Star</Form.Label>
                                    <Form.Control  onChange={this.onStarChange} type="text" placeholder="Star" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Product_code</Form.Label>
                                    <Form.Control  onChange={this.onProduct_codeChange} type="text" placeholder="Product_code" />
                                </Form.Group>
                                <Form.Group >
                                    <Form.Label>Stock</Form.Label>
                                    <Form.Control  onChange={this.onStockChange} type="text" placeholder="Stock" />
                                </Form.Group>
                                <Button variant="primary" type="submit">
                                    Submit
                                </Button>

                            </Form>
                        </Modal.Body>
                        <Modal.Footer>
                            <Button variant="secondary" onClick={this.addNewModalClose}>
                                Close
                            </Button>
                        </Modal.Footer>
                    </Modal>
                </Fragment>
            );
        }
    }
}
export default ProjectsPage;
